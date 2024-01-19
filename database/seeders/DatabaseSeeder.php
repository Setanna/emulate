<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\TalentCategoryController;
use App\Models\RaceSense;
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
        /* Make Admin User */
        function AdminUser($username, $email, $password): void
        {
            $Model = new \App\Models\User();
            $Model->username = $username;
            $Model->email = $email;
            $Model->email_verified_at = now();
            $Model->remember_token = Str::random(10);
            $Model->password = Hash::make($password);
            $Model->save();
            error_log($Model->createToken('authToken', ['change password', 'change email', 'password reset','create', 'read', 'update', 'destroy'])->plainTextToken);
        }
        AdminUser("admin", "admin@gmail.com", 'password');

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
        Book("The Draconic Expansion", "A book for a generic fantasy system filled with draconic options", 1,"2023/11/10");
        Book("The Infernal Realms", "A book for a generic fantasy system filled with fiendish options and devil deals", 1,"2023/11/10");
        Book("The Empyrean Realms", "A book for a generic fantasy system filled with angelic options and divine boons", 1,"2023/11/10");
        Book("Core Rulebook", "The core rulebook for a generic sci-fi system", 2, "2023/11/10");
        Book("Core Rulebook", "The core rulebook for a generic apocalypse system", 3, "2023/11/10");
        Book("Core Rulebook", "The core rulebook for a generic superhero system", 4, "2023/11/10");

        function Talent($name, $experience_cost, $description, $system, $book_id){
            $Model = new \App\Models\Talent();
            $Model->name = $name;
            $Model->experience_cost = $experience_cost;
            $Model->description = $description;
            $Model->system = $system;
            $Model->book_id = $book_id;
            $Model->save();
        }
        Talent("Armor Training", 1, "You gain training in light armor", "You become trained with light armor.", 1);
        Talent("Weapon Training", 1, "You gain training in simple weapons", "You become trained with simple weapons.", 1);
        Talent("Rallying Charge", 1, "You rally your allies and charge forward", "You spend 3 actions to make a call to arms. You and all allies who can hear you can move up to their speed and make a single attack.", 1);
        Talent("Dragon's Blood", 1, "You have the blood of a dragon coursing through you.", "system", 2);
        Talent("Dragon's Breath", 1, "You breathe the elements like the dragons of old", "system", 2);
        Talent("Draconic Scales", 1, "Scales that protect from both the elements and physical blows", "system", 2);
        Talent("Devil Contract", 0, "You make a contract with a Devil for fiendish powers.", "system", 3);
        Talent("Divine Boon", 0, "Your actions have not gone unnoticed, and the heaven's above grant you their blessing.", "system", 4);
        Talent("Xenophobic", -1, "You're xenophobic'", "system", 5);

        function RequiredTalent($talent_id, $required_talent_id){
            $Model = new \App\Models\RequiredTalent();
            $Model->talent_id = $talent_id;
            $Model->required_talent_id = $required_talent_id;
            $Model->save();
        }
        RequiredTalent(5, 4);
        RequiredTalent(6,4);

        function Requirement($name, $description){
            $Model = new \App\Models\Requirement();
            $Model->name = $name;
            $Model->description = $description;
            $Model->save();
        }
        Requirement("Speech", "description");

        function TalentRequirement($talent_id, $requirement_id){
            $Model = new \App\Models\TalentRequirement();
            $Model->talent_id = $talent_id;
            $Model->requirement_id = $requirement_id;
            $Model->save();
        }
        TalentRequirement(3,1);

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
        TalentCategory(1,2);
        TalentCategory(2,1);
        TalentCategory(3,1);
        TalentCategory(3,3);
        TalentCategory(3,5);
        TalentCategory(4,2);
        TalentCategory(5,1);
        TalentCategory(6,2);
        TalentCategory(7,5);
        TalentCategory(8,5);
        TalentCategory(9,8);

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
        TraitModel("Diverse", "description", "Talents with the Diverse trait can be taken any number of times, but any option chosen from the talent can only be chosen once.");

        function TalentTrait($talent_id, $trait_id){
            $Model = new \App\Models\TalentTrait();
            $Model->talent_id = $talent_id;
            $Model->trait_id = $trait_id;
            $Model->save();
        }
        TalentTrait(3,3);
        TalentTrait(7,4);
        TalentTrait(8,4);

        function Rule($name, $text, $book_id){
            $Model = new \App\Models\Rule();
            $Model->name = $name;
            $Model->text = $text;
            $Model->book_id = $book_id;
            $Model->save();
        }
        Rule("Damage Reduction", "Reduction is applied after division. Damage Reduction can reduce damage to 0 but not below.", 1);

        function Sense($name, $description, $system){
            $Model = new \App\Models\Sense();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }
        Sense("Vision", "you can see in bright light using eyes or a similar organ that detects light", "system");
        Sense("Low-Light Vision", "Works like vision except you can also see in dim light", "system");
        Sense("Night Vision", "Works like Low-Light Vision except you can also see in the dark", "system");
        Sense("Echolocation", "you can see using sound", "system");

        function Race($name, $description, $experience_cost, $hit_points, $book_id){
            $Model = new \App\Models\Race();
            $Model->name = $name;
            $Model->description = $description;
            $Model->experience_cost = $experience_cost;
            $Model->hit_points = $hit_points;
            $Model->book_id = $book_id;
            $Model->save();
        }
        Race("Human", "basic boi", 69, 5, 1);
        Race("Dragonkin", "basic boi but with draconic spice", 420, 10, 2);

        function RaceSense($race_id, $sense_id){
            $Model = new \App\Models\RaceSense();
            $Model->race_id = $race_id;
            $Model->sense_id = $sense_id;
            $Model->save();
        }
        RaceSense(1,1);
        RaceSense(2,2);
    }
}
