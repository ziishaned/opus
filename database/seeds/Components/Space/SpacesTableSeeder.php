<?php

namespace Database\Seeds\Components\Space;

use Carbon\Carbon;
use App\Models\Space;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class SpacesTableSeeder extends Seeder
{
	/**
     * Path to spaces.json file.
     * 
     * @var string
     */
    private $spacesFilePath = 'database/seeds/Components/Space/spaces.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spaces = $this->getSpaces();
        
        foreach ($spaces as $space) {
		    Space::insert([
                'name'    => $space['name'], 
                'slug'    => str_slug($space['name'], '_'), 
			    'outline' => $space['outline'], 
			    'user_id' => $space['user_id'], 
                'team_id' => $space['team_id'], 
                'created_at' => Carbon::now(), 
			    'updated_at' => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the spaces from json file. 
     * 
     * @return array $spaces
     */
    private function getSpaces()
    {
        $spaces = file_get_contents(base_path($this->spacesFilePath));

        return json_decode($spaces, true);
    }
}
