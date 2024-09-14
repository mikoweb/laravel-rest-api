<?php

namespace App\Module\Car\Domain\Model;

use App\Core\Infrastructure\Eloquent\HasBinaryUuids;
use App\Core\Infrastructure\Eloquent\Timestampable;
use Cviebrock\EloquentSluggable\Sluggable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpUnitConversion\Unit\Mass\KiloGram;
use PhpUnitConversion\Unit\Mass\Pound;
use PhpUnitConversion\Unit\Volume\Liter;

#[ORM\Entity]
#[ORM\Table(name: 'cars')]
class Car extends Model
{
    /**
     * @use HasFactory<Factory>
     */
    use HasFactory;
    use HasBinaryUuids;
    use Sluggable;
    use Timestampable;

    protected $table = 'cars';
    protected $guarded = [];

    #[ORM\Column(name: 'name', type: Types::STRING, length: 150, unique: true, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'slug', type: Types::STRING, length: 160, unique: true, nullable: false)]
    private string $slug;

    #[ORM\Column(name: 'model', type: Types::STRING, length: 100, nullable: false)]
    private string $model;

    #[ORM\Column(name: 'drive_train', type: Types::STRING, length: 20, nullable: false)]
    private string $driveTrain;

    #[ORM\Column(name: 'engine_size', type: Types::DECIMAL, precision: 3, scale: 1, nullable: false)]
    private string $engineSize;

    #[ORM\Column(name: 'cylinders', type: Types::SMALLINT, nullable: true)]
    private ?int $cylinders;

    #[ORM\Column(name: 'horsepower', type: Types::SMALLINT, nullable: false)]
    private int $horsepower;

    #[ORM\Column(name: 'weight', type: Types::SMALLINT, nullable: false)]
    private int $weight;

    #[ORM\ManyToOne(targetEntity: CarManufacturer::class)]
    #[ORM\JoinColumn(name: 'manufacturer_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private CarManufacturer $manufacturer;

    #[ORM\ManyToOne(targetEntity: CarType::class)]
    #[ORM\JoinColumn(name: 'type_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private CarType $type;

    #[ORM\ManyToOne(targetEntity: CarRegion::class)]
    #[ORM\JoinColumn(name: 'region_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private CarRegion $region;

    public static function create(
        string $name,
        string $model,
        string $driveTrain,
        string $engineSize,
        ?int $cylinders,
        int $horsepower,
        int $weight,
        CarManufacturer $manufacturer,
        CarType $type,
        CarRegion $region,
    ): self {
        $car = new self();
        $car->setAllValues(...func_get_args());

        return $car;
    }

    public function setAllValues(
        string $name,
        string $model,
        string $driveTrain,
        string $engineSize,
        ?int $cylinders,
        int $horsepower,
        int $weight,
        CarManufacturer $manufacturer,
        CarType $type,
        CarRegion $region,
    ): void {
        $this->setRawAttributes([
            'name' => $name,
            'model' => $model,
            'drive_train' => $driveTrain,
            'engine_size' => $engineSize,
            'cylinders' => $cylinders,
            'horsepower' => $horsepower,
            'weight' => $weight,
        ]);

        $this->manufacturer()->associate($manufacturer);
        $this->type()->associate($type);
        $this->region()->associate($region);
    }

    /**
     * @return Builder<static>
     */
    public static function withAll(): Builder
    {
        return self::with(['manufacturer', 'type', 'region']);
    }

    /**
     * @return string[]
     */
    public function getBinaryUuidColumns(): array
    {
        return [
            $this->getKeyName(),
            'manufacturer_id',
            'type_id',
            'region_id',
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);

        return $this;
    }

    public function getSlug(): string
    {
        return $this->getAttribute('slug');
    }

    public function getModel(): string
    {
        return $this->getAttribute('model');
    }

    public function setModel(string $model): self
    {
        $this->setAttribute('model', $model);

        return $this;
    }
    public function getDriveTrain(): string
    {
        return $this->getAttribute('drive_train');
    }

    public function setDriveTrain(string $driveTrain): self
    {
        $this->setAttribute('drive_train', $driveTrain);

        return $this;
    }

    public function getEngineSize(): Liter
    {
        return new Liter((float) $this->getAttribute('engine_size'));
    }

    public function setEngineSize(float $engineSize): self
    {
        $this->setAttribute('engine_size', $engineSize);

        return $this;
    }

    public function getCylinders(): ?int
    {
        return $this->getAttribute('cylinders');
    }

    public function setCylinders(?int $cylinders): self
    {
        $this->setAttribute('cylinders', $cylinders);

        return $this;
    }

    public function getHorsepower(): int
    {
        return $this->getAttribute('horsepower');
    }

    public function setHorsepower(int $horsepower): self
    {
        $this->setAttribute('horsepower', $horsepower);

        return $this;
    }

    public function getWeight(): KiloGram
    {
        /** @var KiloGram $value */
        $value = (new Pound((int) $this->getAttribute('weight')))->to(KiloGram::class);

        return $value;
    }

    public function setWeight(int $weight): self
    {
        $this->setAttribute('weight', $weight);

        return $this;
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(CarManufacturer::class);
    }

    public function getManufacturer(): CarManufacturer
    {
        return $this->getAttribute('manufacturer');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }

    public function getType(): CarType
    {
        return $this->getAttribute('type');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(CarRegion::class);
    }

    public function getRegion(): CarRegion
    {
        return $this->getAttribute('region');
    }
}
