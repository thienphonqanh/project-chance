<?php
class GroupModel extends Model
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

    // Xử lý lấy danh sách nhân sự
    public function handleGetEmployer($filters = [], $keyword = '', $limit)
    {
        $queryGet = $this->db->table('companies')
            ->select('companies.id, companies.name, companies.status, 
                companies.phone, companies.email')
            ->where('companies.group_id', '=', 3);

        $checkNull = false;

        if (!empty($filters)) :
            foreach ($filters as $key => $value) :
                $queryGet->where($key, '=', $value);
            endforeach;
        endif;

        if (!empty($keyword)) :
            $queryGet->where(function ($query) use ($keyword) {
                $query
                    ->where('companies.name', 'LIKE', "%$keyword%")
                    ->orWhere('companies.email', 'LIKE', "%$keyword%")
                    ->orWhere('companies.phone', 'LIKE', "%$keyword%");
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

    // Xử lý lấy danh sách nhân sự
    public function handleGetCandidate($filters = [], $keyword = '', $limit)
    {
        $queryGet = $this->db->table('candidates')
            ->select('candidates.id, candidates.fullname, candidates.email, 
                candidates.status, candidates.create_at, groups.name')
            ->join('groups', 'candidates.group_id = groups.id')
            ->where('candidates.group_id', '=', 2);

        $checkNull = false;

        if (!empty($filters)) :
            foreach ($filters as $key => $value) :
                $queryGet->where($key, '=', $value);
            endforeach;
        endif;

        if (!empty($keyword)) :
            $queryGet->where(function ($query) use ($keyword) {
                $query
                    ->where('candidates.fullname', 'LIKE', "%$keyword%")
                    ->orWhere('candidates.email', 'LIKE', "%$keyword%");
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

    // Xử lý lấy data trang thông tin 
    public function handleViewProfileCandidate($userId)
    {
        $queryGet = $this->db->table('candidates')
            ->select('fullname, thumbnail, email, dob, phone, gender, location, address,
                contact_facebook, contact_twitter, contact_linkedin, about_content')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý lấy data trang thông tin 
    public function handleViewProfileEmployer($userId)
    {
        $queryGet = $this->db->table('companies')
            ->select('fullname, thumbnail, email, phone, location, name, 
                scales, job_category_id, description')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý lấy update trang thông tin 
    public function handleUpdateProfileEmployer($userId, $avatarPath)
    {
        $queryGet = $this->db->table('companies')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'fullname' => $_POST['fullname'],
                'thumbnail' => $avatarPath,
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'location' => $_POST['address'],
                'name' => $_POST['name'],
                'scales' => $_POST['scales'],
                'job_category_id' => $_POST['job_field'],
                'description' => $_POST['description'],
                'update_at' => date('Y-m-d H:i:s'),
            ];

            $updateStatus = $this->db->table('companies')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý lấy update trang thông tin 
    public function handleUpdateProfileCandidate($userId, $avatarPath)
    {
        $queryGet = $this->db->table('candidates')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'fullname' => $_POST['fullname'],
                'thumbnail' => $avatarPath,
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'dob' => $_POST['dob'],
                'gender' => $_POST['gender'],
                'location' => $_POST['location'],
                'address' => $_POST['address'],
                'contact_facebook' => $_POST['contact_facebook'],
                'contact_twitter' => $_POST['contact_twitter'],
                'contact_linkedin' => $_POST['contact_linkedin'],
                'about_content' => $_POST['about_content'],
                'update_at' => date('Y-m-d H:i:s'),
            ];

            $updateStatus = $this->db->table('candidates')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    // Lấy email, phone cũ của personnel
    public function handleGetOldEmployer($userId)
    {
        $queryGet = $this->db->table('companies')
            ->select('email, phone, thumbnail')
            ->where('id', '=', $userId)
            ->first();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Lấy email, phone, ảnh cũ của candidate
    public function handleGetOldCandidate($userId)
    {
        $queryGet = $this->db->table('candidates')
            ->select('email, phone, thumbnail')
            ->where('id', '=', $userId)
            ->first();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }

    // Xử lý duyệt đăng ký dịch vụ của candidate
    public function handleChangeStatusAccountCandidate($userId, $action)
    {
        $queryGet = $this->db->table('candidates')
            ->select('status')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            switch ($action):
                case 'active':
                    $dataUpdate = [
                        'status' => 1,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
                case 'inactive':
                    $dataUpdate = [
                        'status' => 0,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
                case 'unactive':
                    $dataUpdate = [
                        'status' => 2,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
            endswitch;

            $updateStatus = $this->db->table('candidates')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý duyệt đăng ký dịch vụ của personnel
    public function handleChangeStatusAccountEmployer($userId, $action)
    {
        $queryGet = $this->db->table('companies')
            ->select('status')
            ->where('id', '=', $userId)
            ->first();


        if (!empty($queryGet)) :
            switch ($action):
                case 'active':
                    $dataUpdate = [
                        'status' => 1,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
                case 'inactive':
                    $dataUpdate = [
                        'status' => 0,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
                case 'unactive':
                    $dataUpdate = [
                        'status' => 2,
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    break;
            endswitch;

            $updateStatus = $this->db->table('companies')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý xoá nhân sự
    public function handleDeleteEmployer($itemsToDelete = '')
    {
        $itemsToDelete = '(' . $itemsToDelete . ')';

        $queryDelete = $this->db->table('companies')
            ->where('id', 'IN', $itemsToDelete)
            ->delete();

        if ($queryDelete) :
            return true;
        endif;

        return false;
    }

    public function handleDeleteProfile($itemsToDelete = '') 
    {
        $itemsToDelete = '(' . $itemsToDelete . ')';

        $queryDeleteProfike = $this->db->table('profile')
            ->where('candidate_id', 'IN', $itemsToDelete)
            ->delete();
        
        if ($queryDeleteProfike):
            return true;
        endif;
        
        return false;
    }

    public function handleCheckProfile($itemsToDelete = '') {
        $itemsToDelete = '(' . $itemsToDelete . ')';
        
        $queryCheckProfike = $this->db->table('profile')
            ->where('profile.candidate_id', 'IN', $itemsToDelete)
            ->get();

        if (!empty($queryCheckProfike)) :
            return true;
        endif;

        return false;
    }

    // Xử lý xoá ứng viên
    public function handleDeleteCandidate($itemsToDelete = '')
    {
        $itemsToDelete = '(' . $itemsToDelete . ')';

        $queryDeleteProfile = $this->db->table('login_token')
            ->select('id')
            ->where('candidate_id', 'IN', $itemsToDelete)
            ->get();

        if (!empty($queryDeleteProfile)):
            $queryDeleteLogin = $this->db->table('login_token')
                ->where('candidate_id', 'IN', $itemsToDelete)
                ->delete();

            if ($queryDeleteLogin):
                $queryDelete = $this->db->table('candidates')
                    ->where('id', 'IN', $itemsToDelete)
                    ->delete();
    
                if ($queryDelete) :
                    return true;
                endif;
            endif;
        else:
            $queryDelete = $this->db->table('candidates')
                ->where('id', 'IN', $itemsToDelete)
                ->delete();

            if ($queryDelete) :
                return true;
            endif;
        endif;
        
        return false;
    }

    public function handleGetJobField()
    {
        $queryGet = $this->db->table('job_categories')
            ->select('id, name')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = $queryGet;
        endif;

        return $response;
    }
}
