<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RaceSense;
use App\Models\RequiredTalent;
use App\Models\Requirement;
use App\Models\Talent;
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
        function Role($name)
        {
            $Model = new \App\Models\Role();
            $Model->name = $name;
            $Model->save();
        }

        Role("user");
        Role("moderator");
        Role("admin");

        /* Make Admin User */
        function AdminUser($username, $email, $password): void
        {
            $Model = new \App\Models\User();
            $Model->username = $username;
            $Model->email = $email;
            $Model->email_verified_at = now();
            $Model->remember_token = Str::random(10);
            $Model->role_id = 3;
            $Model->password = Hash::make($password);
            $Model->save();
            error_log($Model->createToken('authToken', ['change password', 'change email', 'password reset', 'create', 'read', 'update', 'destroy'])->plainTextToken);
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

        Genre("Fantasy", "Generic fantasy ttrpg with dragons, orcs and loot galore.");
        Genre("Sci-Fi", "Generic sci-fi ttrpg with spaceships, xenos and tech galore");
        Genre("Superhero", "Generic superhero ttrpg with sidekicks, villains and banter galore");

        function Book($name, $description, $genre_id, $publication_date)
        {
            $Model = new \App\Models\Book();
            $Model->name = $name;
            $Model->description = $description;
            $Model->genre_id = $genre_id;
            $Model->publication_date = $publication_date;
            $Model->save();
        }

        /* Fantasy */
        Book("Core Rulebook", "The core rulebook for a generic fantasy system", 1, "2023/11/10");
        Book("The Draconic Expansion", "A book for a generic fantasy system filled with draconic options", 1, "2023/11/10");
        Book("The Infernal Realms", "A book for a generic fantasy system filled with fiendish options and devil deals", 1, "2023/11/10");
        Book("The Empyrean Realms", "A book for a generic fantasy system filled with angelic options and divine boons", 1, "2023/11/10");
        Book("The Shadows of Death", "A book for a generic fantasy system filled with undead minions and necrotic spells", 1, "2023/11/10");
        /* Sci-fi */
        Book("Core Rulebook", "The core rulebook for a generic sci-fi system", 2, "2023/11/10");
        /* Superhero */
        Book("Core Rulebook", "The core rulebook for a generic superhero system", 3, "2023/11/10");

        function Talent($name, $experience_cost, $description, $system, $book_id)
        {
            $Model = new \App\Models\Talent();
            $Model->name = $name;
            $Model->experience_cost = $experience_cost;
            $Model->description = $description;
            $Model->system = $system;
            $Model->book_id = $book_id;
            $Model->save();
        }

        /* Fantasy */
        Talent("Armor Training", 1, "You gain training in light armor", "You become trained with light armor.", 1);
        Talent("Weapon Training", 1, "You gain training in simple weapons", "You become trained with simple weapons.", 1);
        Talent("Rallying Charge", 1, "You rally your allies and charge forward", "You spend 3 actions to make a call to arms. You and all allies who can hear you can move up to their speed and make a single attack.", 1);
        Talent("Dragon's Blood", 1, "You have the blood of a dragon coursing through you.", "system", 2);
        Talent("Dragon's Breath", 1, "You breathe the elements like the dragons of old", "system", 2);
        Talent("Draconic Scales", 1, "Scales that protect from both the elements and physical blows", "system", 2);
        Talent("Devil Contract", 0, "You make a contract with a Devil for fiendish powers.", "system", 3);
        Talent("Divine Boon", 0, "Your actions have not gone unnoticed, and the heaven's above grant you their blessing.", "system", 4);
        Talent("Animate Dead", 1, "You reanimate the dead to do your bidding", "Spend XP up to half the targets XP. The creature reanimates as undead with only the given amount of XP available for the talents it had in life. When the minion dies, you regain the amount of XP spent, this XP can only be used on Animate Dead. Pay additional XP depending on size.", 5);
        Talent("Mass Animate Dead", 3, "Reanimate an army at the snap of your fingers", "As Animate Dead, but any number of targets", 5);
        Talent("Undead Militia", 5, "Your undead are stronger and more versatile", "All undead created by you, using animate dead, gain Armor Training (All) and Weapon Training (All)", 5);
        Talent("Condescending Teamwork", 5, "Your belief that you're better than everyone else allows you to pull others to your level.", "Your allies count as minion for talents with the minion trait.", 1);
        /* Sci-fi */
        Talent("Xenophobic", -1, "You're xenophobic", "system", 6);
        /* Superhero */
        Talent("Let Loose", 10, "You're always holding back", "Double your physical stats in dire situations", 7);

        /* Sync talents with required talent relations */
        Talent::find(5)->required_talents()->sync([4]);
        Talent::find(6)->required_talents()->sync([4]);
        Talent::find(10)->required_talents()->sync([9]);
        Talent::find(11)->required_talents()->sync([10]);


        function Requirement($name, $description)
        {
            $Model = new \App\Models\Requirement();
            $Model->name = $name;
            $Model->description = $description;
            $Model->save();
        }

        Requirement("Verbal", "A talent with this requirement needs words or sound spoken or played on an instrument.");
        Requirement("Somatic", "A talent with this requirement needs both hands free, or wielding the specified equipment");
        Requirement("Material", "A talent with this requirement needs some sort of material to be used. The material is consumed only if the talent states so");
        Requirement("Good", "A talent with this requirement needs the user to be a good person");

        /* Sync talents with requirements relations */
        Talent::find(3)->talent_requirements()->sync([1]);
        Talent::find(9)->talent_requirements()->sync([1, 2, 3]);
        Talent::find(14)->talent_requirements()->sync([4]);

        function Category($name, $description, $system)
        {
            $Model = new \App\Models\Category();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        Category("Combat", "A talent that deals or reduces damage.", "system");
        Category("Movement", "A talent that includes movement or that moves another target", "system");
        Category("Augment", "A talent that alters another talent, either buffing, debuffing or changing how it works", "system");
        Category("Utility", "A talent that typically is non-combat, which interacts with environment, or offers other solutions to problems", "system");
        Category("Social", "A talent that increases ones sociability, connections, or standing in a faction", "system");
        Category("Flaw", "A talent that is a detriment to a character, but grants other advantages", "system");
        Category("Teamwork", "A talent that only works together with allies that share the same talent", "system");

        /* Sync talents with category relations */
        Talent::find(1)->talent_categories()->sync([1]);
        Talent::find(2)->talent_categories()->sync([1]);
        Talent::find(3)->talent_categories()->sync([1, 2]);
        Talent::find(4)->talent_categories()->sync([1]);
        Talent::find(5)->talent_categories()->sync([1]);
        Talent::find(6)->talent_categories()->sync([1]);
        Talent::find(7)->talent_categories()->sync([4]);
        Talent::find(8)->talent_categories()->sync([4]);
        Talent::find(9)->talent_categories()->sync([4]);
        Talent::find(10)->talent_categories()->sync([3, 4]);
        Talent::find(11)->talent_categories()->sync([3, 4]);
        Talent::find(12)->talent_categories()->sync([3, 5]);
        Talent::find(13)->talent_categories()->sync([6]);
        Talent::find(14)->talent_categories()->sync([1]);

        function TraitModel($name, $description, $system)
        {
            $Model = new \App\Models\TraitModel();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        TraitModel("Magic", "A talent that involves the use of magic.", "Talents with the magic trait don't work in no magic zones");
        TraitModel("Diverse", "A talent with a wide array of options to choose from.", "Talents with the Diverse trait can be taken any number of times, but any option chosen from the talent can only be chosen once.");
        TraitModel("Heritage", "A talent that gives you power through your bloodline. ", "system");
        TraitModel("Minion", "A talent that grants control over a minion, such as a pet or undead, or involves a minion", "Talents with the minion trait only work on minions or create minions");

        /* Sync talents with trait relations */
        Talent::find(4)->talent_traits()->sync([3]);
        Talent::find(5)->talent_traits()->sync([3]);
        Talent::find(6)->talent_traits()->sync([3]);
        Talent::find(7)->talent_traits()->sync([2]);
        Talent::find(8)->talent_traits()->sync([2]);
        Talent::find(9)->talent_traits()->sync([1, 4]);
        Talent::find(10)->talent_traits()->sync([1, 4]);
        Talent::find(11)->talent_traits()->sync([1, 4]);
        Talent::find(12)->talent_traits()->sync([4]);

        function Rule($name, $text, $book_id)
        {
            $Model = new \App\Models\Rule();
            $Model->name = $name;
            $Model->text = $text;
            $Model->book_id = $book_id;
            $Model->save();
        }

        Rule("Damage Reduction", "Reduction is applied after division. Damage Reduction can reduce damage to 0 but not below.", 1);

        function Sense($name, $description, $system)
        {
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

        function Race($name, $description, $experience_cost, $hit_points, $book_id)
        {
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

        function RaceSense($race_id, $sense_id)
        {
            $Model = new \App\Models\RaceSense();
            $Model->race_id = $race_id;
            $Model->sense_id = $sense_id;
            $Model->save();
        }

        RaceSense(1, 1);
        RaceSense(2, 2);

        function Type($name, $description, $system)
        {
            $Model = new \App\Models\Type();
            $Model->name = $name;
            $Model->description = $description;
            $Model->system = $system;
            $Model->save();
        }

        Type("Humanoid", "A typical humanoid", "system");
        Type("Undead", "A corpse mimicking the echoes of its former life", "system");
        Type("Elemental", "Pure element given life through unknown means", "system");
        Type("Draconic", "Ancient scaled beasts of many shapes and sizes", "system");

        function RaceType($race_id, $type_id)
        {
            $Model = new \App\Models\RaceType();
            $Model->race_id = $race_id;
            $Model->type_id = $type_id;
            $Model->save();
        }

        RaceType(1, 1);
        RaceType(2, 4);
    }
}
