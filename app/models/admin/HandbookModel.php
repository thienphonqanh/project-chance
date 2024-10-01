<?php
class HandbookModel extends Model
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

    public function handleAddHandbook($data, $avatarPath)
    {
        $dataInsert = [
            'title' => $data['title'],
            'slug' => $data['slug'],
            'thumbnail' => $avatarPath,
            'handbook_category_id' => $data['main_category'],
            'handbook_sub_category_id' => $data['sub_category'],
            'descr' => $_POST['descr'],
            'admin_id' => getIdUserLogin(),
            'content' => $_POST['content'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = $this->db->table('handbooks')
            ->insert($dataInsert);

        if ($insertStatus) :
            return true;
        endif;

        return false;
    }

    public function handleUpdateHandbook($data, $handbookId, $avatarPath)
    {
        $queryGet = $this->db->table('handbooks')
            ->where('id', '=', $handbookId)
            ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'thumbnail' => $avatarPath,
                'handbook_category_id' => $data['main_category'],
                'handbook_sub_category_id' => $data['sub_category'],
                'descr' => $_POST['descr'],
                'admin_id' => getIdUserLogin(),
                'content' => $_POST['content'],
                'update_at' => date('Y-m-d H:i:s'),
            ];

            $updateStatus = $this->db->table('handbooks')
                ->where('handbooks.id', '=', $handbookId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    public function handleDelete($itemsToDelete = '')
    {
        $itemsToDelete = '(' . $itemsToDelete . ')';

        $queryDelete = $this->db->table('handbooks')
            ->where('id', 'IN', $itemsToDelete)
            ->delete();

        return $queryDelete ? true : false;
    }

    public function handleGetCategory()
    {
        $queryGet = $this->db->table('handbook_categories')
            ->select('id, name, slug')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetSubCategory($categoryId)
    {
        $queryGet = $this->db->table('handbook_sub_categories')
            ->select('id, name, slug')
            ->where('handbook_category_id', '=', $categoryId)
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetAllCategory()
    {
        $queryGet = $this->db->table('handbook_categories')
            ->select('id, name, slug')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetAllSubCategory()
    {
        $queryGet = $this->db->table('handbook_sub_categories')
            ->select('id, name, slug')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetDetail($handbookId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.title, handbooks.slug, handbooks.thumbnail, handbooks.descr, handbooks.create_at,
                handbooks.content, handbooks.view_count, handbook_categories.name as main_category_name,
                handbook_categories.slug as main_category_slug, handbook_sub_categories.name as sub_category_name,
                handbook_sub_categories.slug as sub_category_slug, admins.fullname as author')
            ->join('handbook_sub_categories', 'handbook_sub_categories.id = handbooks.handbook_sub_category_id')
            ->join('handbook_categories', 'handbook_categories.id = handbooks.handbook_category_id')
            ->join('admins', 'admins.id = handbooks.admin_id')
            ->where('handbooks.id', '=', $handbookId)
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetListHandbook($filters = [], $keyword = '', $limit)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.id, handbooks.title, handbooks.slug, handbooks.create_at, 
                handbooks.view_count, handbook_categories.name as main_category_name, 
                admins.fullname as author')
            ->join('handbook_categories', 'handbook_categories.id = handbooks.handbook_category_id')
            ->join('admins', 'admins.id = handbooks.admin_id')
            ->orderBy('handbooks.create_at', 'DESC');

        $response = [];
        $checkNull = false;

        if (!empty($filters)) :
            foreach ($filters as $key => $value) :
                $queryGet->where($key, '=', $value);
            endforeach;
        endif;

        if (!empty($keyword)) :
            $queryGet->where(function ($query) use ($keyword) {
                $query
                    ->where('handbooks.title', 'LIKE', "%$keyword%")
                    ->orWhere('admins.fullname', 'LIKE', "%$keyword%");
            });
        endif;

        $queryGet = $queryGet->paginate($limit);

        if (!empty($queryGet['data'])) :
            foreach ($queryGet['data'] as $key => $item) :
                foreach ($item as $subKey => $subItem) :
                    if ($subItem === NULL || $subItem === '') :
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý hàm tăng view
    public function handleSetViewCount($handbookId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('view_count')
            ->where('id', '=', $handbookId)
            ->first();

        $check = false;

        if (!empty($queryGet)) :
            $view = $queryGet['view_count'];
            $view++;
            $check = true;
        else :
            if (is_array($queryGet)) :
                $view = 1;
                $check = true;
            endif;
        endif;

        if ($check) :
            $dataUpdate = [
                'view_count' => $view
            ];

            $this->db->table('handbooks')
                ->where('handbooks.id', '=', $handbookId)
                ->update($dataUpdate);
        endif;
    }

    // Xử lý lấy data trang thông tin 
    public function handleViewHandbook($handbookId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.id, handbooks.title, handbooks.slug, handbooks.thumbnail,
                handbooks.descr, handbooks.content, handbook_categories.name as main_category_name,
                handbook_sub_categories.name as sub_category_name')
            ->join('handbook_categories', 'handbook_categories.id = handbooks.handbook_category_id')
            ->join('handbook_sub_categories', 'handbook_sub_categories.id = handbooks.handbook_sub_category_id')
            ->where('handbooks.id', '=', $handbookId)
            ->get();

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCheckHandbookId($handbookId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('id')
            ->where('id', '=', $handbookId)
            ->first();

        if (!empty($queryGet)) :
            return true;
        endif;

        return false;
    }

    // Lấy thumbnail cũ
    public function handleGetOld($handbookId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('thumbnail')
            ->where('id', '=', $handbookId)
            ->first();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý lấy danh sách việc làm mới
    public function handleGetListNewJob()
    {
        $queryGet = $this->db->table('jobs')
            ->select('jobs.id, jobs.thumbnail, jobs.title, jobs.location, jobs.salary, 
                jobs.slug, jobs.exp_required, companies.name')
            ->join('companies', 'jobs.company_id = companies.id')
            ->join('job_categories', 'jobs.job_category_id = job_categories.id')
            ->orderBy('jobs.create_at', 'DESC')
            ->limit(10)
            ->get();

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetListSameCategory($handbookId)
    {
        $queryGetSubCategory = $this->db->table('handbooks')
            ->select('handbook_sub_category_id')
            ->where('handbooks.id', '=', $handbookId)
            ->first();

        $response = [];

        if (!empty($queryGetSubCategory)) :
            $queryGet = $this->db->table('handbooks')
                ->select('handbooks.id, handbooks.title, handbooks.slug, 
                    handbooks.thumbnail, handbook_sub_categories.name')
                ->join('handbook_sub_categories', 'handbook_sub_categories.id = handbooks.handbook_sub_category_id')
                ->where('handbooks.handbook_sub_category_id', '=', $queryGetSubCategory['handbook_sub_category_id'])
                ->where('handbooks.id', '!=', $handbookId)
                ->orderBy('handbooks.create_at', 'DESC')
                ->limit(4)
                ->get();

            if (!empty($queryGet)) :
                $response = $queryGet;
            endif;
        endif;

        return $response;
    }

    public function handleGetRandomHandbook()
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.id, handbooks.slug, handbooks.title, handbooks.thumbnail,
                handbooks.descr, handbook_sub_categories.name')
            ->join('handbook_sub_categories', 'handbooks.handbook_sub_category_id = handbook_sub_categories.id')
            ->orderBy('handbooks.create_at', 'DESC')
            ->limit(3)
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetHandbookFromPageLimit($categoryId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.id, handbooks.thumbnail, handbooks.slug, handbooks.title, 
                handbooks.descr, handbook_sub_categories.name')
            ->join('handbook_sub_categories', 'handbooks.handbook_sub_category_id = handbook_sub_categories.id')
            ->where('handbooks.handbook_category_id', '=', $categoryId)
            ->orderBy('handbooks.create_at', 'DESC')
            ->limit(6)
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleGetHandbookFromPage($categoryId)
    {
        $queryGet = $this->db->table('handbooks')
            ->select('handbooks.id, handbooks.thumbnail, handbooks.slug, handbooks.title, 
                handbooks.descr, handbook_sub_categories.name')
            ->join('handbook_sub_categories', 'handbooks.handbook_sub_category_id = handbook_sub_categories.id')
            ->where('handbooks.handbook_category_id', '=', $categoryId)
            ->orderBy('handbooks.create_at', 'DESC')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }
}
