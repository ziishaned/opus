<?php

namespace Database\Seeds\Components\Wiki;

use Carbon\Carbon;
use App\Models\Wiki;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class WikisTableSeeder extends Seeder
{
	/**
     * Path to wikis.json file.
     * 
     * @var string
     */
    private $wikisFilePath = 'database/seeds/Components/Wiki/wikis.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wikis = $this->getWikis();
        
        foreach ($wikis as $wiki) {
		    Wiki::insert([
     			'name'	 	  => $wiki['name'],
			    'slug'  	  => str_slug($wiki['name'], '_'),
     			'outline'	  => $wiki['outline'],
     			'description' => $wiki['description'],
     			'user_id'	  => $wiki['user_id'],
     			'space_id'	  => $wiki['space_id'],
     			'team_id'	  => $wiki['team_id'],
                'created_at'  => Carbon::now(), 
                'updated_at'  => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the wikis from json file. 
     * 
     * @return array $wikis
     */
    private function getWikis()
    {
        $wikis = file_get_contents(base_path($this->wikisFilePath));

        return json_decode($wikis, true);
    }
}
