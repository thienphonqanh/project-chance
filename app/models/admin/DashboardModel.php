<?php
class DashboardModel extends Model
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

    public function handleChangePassword($userId)
    {
        $checkOldPass = $this->db->table('admins')
            ->select('password')
            ->where('id', '=', $userId)
            ->first();

        if (password_verify($_POST['old_password'], $checkOldPass['password'])) :
            if (!password_verify($_POST['new_password'], $checkOldPass['password'])) :
                $dataUpdate = [
                    'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT)
                ];

                $updateStatus = $this->db->table('admins')
                    ->where('id', '=', $userId)
                    ->update($dataUpdate);

                if ($updateStatus) :
                    return true;
                endif;
            else :
                Session::flash('msg', 'Bạn đang dùng mật khẩu này');
                Session::flash('msg_type', 'danger');
            endif;
        else :
            Session::flash('msg', 'Mật khẩu cũ chưa chính xác');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    public function handleCountCandidate()
    {
        $queryGet = $this->db->table('candidates')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = count($queryGet);
        else :
            $response = 0;
        endif;

        return $response;
    }

    public function handleCountHandbook()
    {
        $queryGet = $this->db->table('handbooks')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = count($queryGet);
        else :
            $response = 0;
        endif;

        return $response;
    }

    public function handleCountEmployer()
    {
        $queryGet = $this->db->table('companies')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = count($queryGet);
        else :
            $response = 0;
        endif;

        return $response;
    }

    public function handleCountJob()
    {
        $queryGet = $this->db->table('jobs')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)) :
            $response = count($queryGet);
        else :
            $response = 0;
        endif;

        return $response;
    }
}
