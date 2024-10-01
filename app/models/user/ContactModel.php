<?php
class ContactModel extends Model
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

    public function handleContact($userId)
    {
        $dataInsert = [
            'candidate_id' => $userId,
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'message' => $_POST['message'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = $this->db->table('contacts')
            ->insert($dataInsert);

        if ($insertStatus) :
            return true;
        endif;

        return false;
    }
}
