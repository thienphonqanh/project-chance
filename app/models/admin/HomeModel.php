<?php
class HomeModel extends Model
{
    public function tableFill()
    {
        return '';
    }

    public function fieldFill()
    {
        return '';
    }

    public function primaryKey()
    {
        return '';
    }

    public function handleGetJobCategory()
    {
        $queryGet = $this->db->table('job_categories')
            ->select('id, name, icon, slug')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetOutstandingJob()
    {
        $queryGet = $this->db->table('jobs')
            ->select('jobs.id, jobs.title, jobs.thumbnail, jobs.location, 
                jobs.slug, jobs.salary, companies.name, jobs.create_at')
            ->orderBy('jobs.create_at', 'DESC')
            ->join('companies', 'companies.id = jobs.company_id')
            ->where('jobs.view_count', '>', '100')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetSomeHandbooks()
    {
        $queryGet = $this->db->table('handbooks')
            ->select('id, thumbnail, slug, title, descr')
            ->orderBy('create_at', 'DESC')
            ->limit(3)
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }
}
