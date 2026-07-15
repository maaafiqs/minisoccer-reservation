<?php
use App\Models\InventoryItem;
use App\Models\InventoryCategory;
use Faker\Factory as Faker;

$faker = Faker::create('id_ID');
$categories = InventoryCategory::pluck('id')->toArray();

if (empty($categories)) {
    echo "No categories found.\n";
    exit;
}

$items = [];
for ($i = 1; $i <= 50; $i++) {
    $items[] = [
        'inventory_category_id' => $faker->randomElement($categories),
        'item_code' => 'INV-' . strtoupper($faker->bothify('???-###')),
        'name' => ucwords($faker->words(2, true)) . ' ' . $faker->randomElement(['Pro', 'Max', 'Lite', 'Sport', 'Elite', 'Basic', 'Advance']),
        'brand' => $faker->randomElement(['Nike', 'Adidas', 'Puma', 'Specs', 'Ortuseight', 'Mizuno', 'Molten', 'Mikasa', 'Mitre', 'Kelme']),
        'quantity' => $faker->numberBetween(1, 50),
        'status' => $faker->randomElement(['baik', 'baik', 'baik', 'rusak']), // 75% chance of being good
        'created_at' => now(),
        'updated_at' => now(),
    ];
}

InventoryItem::insert($items);
echo "50 items seeded successfully.\n";
