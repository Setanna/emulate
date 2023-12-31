<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\TalentCategoryController;
use App\Models\RequiredTalent;
use App\Models\Requirement;
use App\Models\TalentCategory;
use App\Models\TalentRequirement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        function User($username, $email, $password): void
        {
            $Model = new \App\Models\User();
            $Model->username = $username;
            $Model->email = $email;
            $Model->email_verified_at = now();
            $Model->remember_token = Str::random(10);
            $Model->password = Hash::make($password);
            $Model->save();
        }
        User("test", "test@gmail.com", 'password');

        function Genre($name, $description): void
        {
            $Model = new \App\Models\Genre();
            $Model->name = $name;
            $Model->description = $description;
            $Model->save();
        }
        Genre("Fantasy", "Generic fantasy ttrpg with dragons and orcs galore.");
        Genre("Sci-Fi", "Generic sci-fi ttrpg with spaceships and aliens galore");
        Genre("Apocalypse", "Generic apocalypse ttrpg with factions and moral dilemmas galore");
        Genre("Superhero", "Generic superhero ttrpg with sidekicks and villains galore");

        function Book($name, $description, $genre_id, $publication_date){
            $Model = new \App\Models\Book();
            $Model->name = $name;
            $Model->description = $description;
            $Model->genre_id = $genre_id;
            $Model->publication_date = $publication_date;
            $Model->save();
        }
        Book("Core Rulebook", "The core rulebook for a generic fantasy system", 1,"2023/11/10");
        Book("Core Rulebook", "The core rulebook for a generic sci-fi system", 2, "2023/11/10");

        function Talent($name, $rank, $description, $system, $book_id){
            $Model = new \App\Models\Talent();
            $Model->name = $name;
            $Model->rank = $rank;
            $Model->description = $description;
            $Model->system = $system;
            $Model->book_id = $book_id;
            $Model->save();
        }
        Talent("Armor Training", 1, "You gain training in light armor", "system", 1);
        Talent("Armor Training", 2, "You gain training in medium armor", "system", 1);
        Talent("Weapon Training", 1, "You gain training in simple weapons", "system", 1);
        Talent("Weapon Training", 2, "You gain training in martial weapons", "system", 1);
        Talent("Rallying Charge", 1, "You rally your allies and charge forward", "system", 1);
        Talent("Rallying Charge", 2, "You rally your allies and charge forward", "system", 1);

        function RequiredTalent($talent_id, $required_talent_id){
            $Model = new \App\Models\RequiredTalent();
            $Model->talent_id = $talent_id;
            $Model->required_talent_id = $required_talent_id;
            $Model->save();
        }
        RequiredTalent(2,1);
        RequiredTalent(4,3);
        RequiredTalent(6,5);

        function Requirement($name, $description){
            $Model = new \App\Models\Requirement();
            $Model->name = $name;
            $Model->description = $description;
            $Model->save();
        }
        Requirement("test1", "lorem ipsum");
        Requirement("speech", "lorem ipsum");

        function TalentRequirement($talent_id, $requirement_id){
            $Model = new \App\Models\TalentRequirement();
            $Model->talent_id = $talent_id;
            $Model->requirement_id = $requirement_id;
            $Model->save();
        }
        TalentRequirement(1,1);
        TalentRequirement(2,1);
        TalentRequirement(5, 2);
        TalentRequirement(6, 2);

        function Category($name, $description, $system){
            $Model = new \App\Models\Category();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }
        Category("Offense", "A talent in this category, deals damage or increases damage dealt.", "Rulings");
        Category("Defense", "A talent in this category, reduces damage taken.", "Rulings");
        Category("Movement", "A talent in this category, increases movement or moves something or someone.", "Rulings");
        Category("Utility", "A talent in this category, has a solution to a problem.", "Rulings");
        Category("Buff", "A talent in this category, increases another category's effects, such as buffing offense.", "Rulings");
        Category("Debuff", "A talent in this category, decreases another category's effects, such as debuffing defense.", "Rulings");
        Category("Social", "A talent in this category, has social effects, such as higher sell rates or owning a platoon of soldiers.", "Rulings");
        Category("Flaw", "A talent in this category, is a detriment to a character.", "Rulings");

        function TalentCategory($talent_id, $category_id){
            $Model = new \App\Models\TalentCategory();
            $Model->talent_id = $talent_id;
            $Model->category_id = $category_id;
            $Model->save();
        }
        TalentCategory(2,1);
        TalentCategory(1,2);
        TalentCategory(5, 1);
        TalentCategory(5, 3);
        TalentCategory(5, 5);
        TalentCategory(6, 1);
        TalentCategory(6, 3);
        TalentCategory(6, 5);

        function TraitModel($name, $description, $system){
            $Model = new \App\Models\TraitModel();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }
        TraitModel("Fire", "Controls, manipulates or creates heat and fire", "system");
        TraitModel("Sturdy", "Hard to damage", "system");
        TraitModel("Verbal", "Must be spoken or otherwise make sound such as yelling or instruments", "system");

        function TalentTrait($talent_id, $trait_id){
            $Model = new \App\Models\TalentTrait();
            $Model->talent_id = $talent_id;
            $Model->trait_id = $trait_id;
            $Model->save();
        }
        TalentTrait(6,3);

        function Rule($name, $text, $book_id){
            $Model = new \App\Models\Rule();
            $Model->name = $name;
            $Model->text = $text;
            $Model->book_id = $book_id;
            $Model->save();
        }
        Rule("Damage Reduction", "Reduction is applied after division. Damage Reduction can reduce damage to 0 but not below.", 1);
    }
}
