<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class Search extends Component
{
    private $profiles = null;
    public $search = null;
    public $results = null;
    public function findProfile($search)
    {
        if ($search != null) {
            $this->profiles =
                Project::where('name', 'LIKE', '%' . $search . '%')->where('id', '<>', auth()->user()->id)
                ->take(5)
                ->get();
        } else {
            $this->profiles = null;
            $this->results = null;
        }

        if ($this->profiles != null) {
            $fields = array();
            $filtered = array();
            foreach ($this->profiles as $profile) {

                $fields['username'] = $profile->name;
                $fields['status'] = $profile->status;
                $fields['id'] = $profile->id;
                $fields['description'] = $profile->description;
                $fields['created_at'] = $profile->created_at;
                $fields['tasks'] = $profile->tasks;
                $fields['nextdate'] = $profile->nextdate;


                $filtered[] = $fields;
            }
            $this->results = $filtered;
        }
    }
    public function render()
    {
        return view('livewire.search');
    }
}
