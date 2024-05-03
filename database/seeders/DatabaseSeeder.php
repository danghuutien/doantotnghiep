<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AttributeDetailsTableSeeder::class);
        $this->call(AttributeVariantMapsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(LanguageMetasTableSeeder::class);
        $this->call(MediasTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(OrderHistoriesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PostCategoriesTableSeeder::class);
        $this->call(PostCategoryMapsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ProductAttributeMapsTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductCategoryAttributeMapsTableSeeder::class);
        $this->call(ProductCategoryMapsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(SeosTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(SyncLinksTableSeeder::class);
        $this->call(SystemLogsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(VariantsTableSeeder::class);
    }
}
