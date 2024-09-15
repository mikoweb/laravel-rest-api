<?php

namespace App\Module\Sale\Domain\Model;

use App\Core\Infrastructure\Eloquent\HasBinaryUuids;
use App\Core\Infrastructure\Eloquent\Timestampable;
use Cviebrock\EloquentSluggable\Sluggable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Doctrine\UuidBinaryType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sale_offers')]
#[ORM\Index(fields: ['carId'], name: 'sale_offers_car_id')]
class SaleOffer extends Model
{
    /**
     * @use HasFactory<Factory>
     */
    use HasFactory;
    use HasBinaryUuids;
    use Sluggable;
    use Timestampable;

    protected $table = 'sale_offers';
    protected $guarded = [];

    #[ORM\Column(name: 'title', type: Types::STRING, length: 100, nullable: false)]
    private string $title;

    #[ORM\Column(name: 'slug', type: Types::STRING, length: 110, unique: true, nullable: false)]
    private string $slug;

    #[ORM\Column(name: 'content', type: Types::TEXT, nullable: false)]
    private string $content;

    #[ORM\Column(name: 'price', type: Types::DECIMAL, precision: 9, scale: 2)]
    private string $price;

    #[ORM\Column(name: 'currency_code', type: Types::STRING, length: 3, nullable: false)]
    private string $currencyCode;

    #[ORM\Column(name: 'car_id', type: UuidBinaryType::NAME, nullable: false)]
    private string $carId;

    public static function create(
        string $title,
        string $content,
        Money $price,
        UuidInterface $carId,
    ): self {
        $sale = new self([
            'title' => $title,
            'content' => $content,
            'car_id' => $carId->getBytes(),
        ]);

        $sale->setPrice($price);

        return $sale;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function getBinaryUuidColumns(): array
    {
        return [
            $this->getKeyName(),
            'car_id',
        ];
    }

    public function getTitle(): string
    {
        return $this->getAttribute('title');
    }

    public function setTitle(string $title): self
    {
        $this->setAttribute('title', $title);

        return $this;
    }

    public function getSlug(): string
    {
        return $this->getAttribute('slug');
    }

    public function getContent(): string
    {
        return $this->getAttribute('content');
    }

    public function setContent(string $content): self
    {
        $this->setAttribute('content', $content);

        return $this;
    }

    public function getPrice(): Money
    {
        return new Money(
            (int) (((float) $this->getAttribute('price')) * 100),
            new Currency($this->getAttribute('currency_code')),
        );
    }

    public function setPrice(Money $price): self
    {
        $this->setAttribute('price', (int) $price->getAmount() / 100);
        $this->setAttribute('currency_code', strtoupper($price->getCurrency()->getCode()));

        return $this;
    }

    public function getCarId(): UuidInterface
    {
        return Uuid::fromBytes($this->getAttribute('car_id'));
    }

    public function setCarId(UuidInterface $carId): self
    {
        $this->setAttribute('car_id', $carId->getBytes());

        return $this;
    }
}
