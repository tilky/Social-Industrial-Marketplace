<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','title','like_to_post_as','job_type_function','job_position_title','city','state','country','does_not_apply','job_type','travel_required','how_often',
                            'summary','experience_required','education_level','addition_qualification_requirement','skills_expertise','compensation_type','compensation_range',
                            'additional_compensation','expiry_date','status','payment_date','payment_status','unique_number','external_url'
                            ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * get Buyer Data
     */
    public function jobUser()
    {
        return $this->belongsTo('App\User',"user_id");
    }
    
    /**
     * Get the job apply
     */
    public function jobapply()
    {
        return $this->hasMany('App\JobsApply','job_id');
    }
    
    /**
     * Get the quote devirsities
     */
    public function jobsave()
    {
        return $this->hasMany('App\JobsSave','job_id');
    }
    
    /**
     * get Similar Jobs
     */
    protected function getSimilarJob($job_id)
    {
        $job = Jobs::find($job_id);
        $jobIds = array();
        
        // filter using podition
        $position = $job->job_type_function;
        $jobs = Jobs::where('job_type_function',$position)->whereNotIn('id',array($job_id))->orderBy('id','desc')->take(6)->get();
        foreach($jobs as $jobData)
        {
            $jobIds[] = $jobData->id;
        }
        
        // skills
        $skillArray = array();
        if($job->skills_expertise != ''){
            if(@unserialize($job->skills_expertise))
            {
                $item_specifics_value = unserialize($job->skills_expertise);
                if(!empty($item_specifics_value))
                {
                    foreach($item_specifics_value as $skill)
                    {
                        $skillArray[] = $skill['name'];
                        $jobs_obj = Jobs::where('skills_expertise', 'like', '%'.$skill['name'].'%')->whereNotIn('id',array($job_id))->orderBy('id','desc')->take(6)->get();
                        if($jobs_obj)
                        {
                            foreach($jobs_obj as $job_obj)
                            {
                                $jobIds[] = $job_obj->id;    
                            }
                        }
                    }
                }
            }
        }
        $similarJobs = Jobs::whereIn('id',$jobIds)->orderBy('id','desc')->take(6)->get();
        return $similarJobs;
    }

    
}
