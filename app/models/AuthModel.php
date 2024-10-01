<?php
class AuthModel extends Model
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

    // Xử lý login
    public function handleLogin($username, $password)
    {
        $queryGet = $this->handleGetWithRole($username);

        if (!empty($queryGet) && $queryGet['group_id'] !== 3) :
            $passwordHash = $queryGet['password'];
            $userId = $queryGet['id'];
            $statusAccount = $queryGet['status'];
            $groupId = $queryGet['group_id'];

            if (password_verify($password, $passwordHash)) :
                $loginToken = sha1(uniqid() . time());

                if ($groupId === 1) :
                    $dataToken = [
                        'admin_id' => $userId,
                        'token' => $loginToken,
                        'create_at' => date('Y-m-d H:i:s')
                    ];

                    $tableName = 'admins';
                endif;

                if ($groupId === 2) :
                    $dataToken = [
                        'candidate_id' => $userId,
                        'token' => $loginToken,
                        'create_at' => date('Y-m-d H:i:s')
                    ];

                    $tableName = 'candidates';
                endif;

                if ($statusAccount === 1) :
                    $insertTokenStatus = $this->db->table('login_token')->insert($dataToken);
                    if ($insertTokenStatus && $groupId !== 3) :
                        // Lưu login token vào session
                        Session::data('login_token_user', $loginToken);
                        // Lưu thông tin người đăng nhập
                        $this->handleSaveUserData($tableName, $userId);

                        return true;
                    endif;
                endif;

                if ($statusAccount === 0) :
                    Session::flash('msg', 'Vui lòng kích hoạt tài khoản tại Gmail bạn dùng để đăng ký tài khoản');
                    Session::flash('msg_type', 'danger');
                endif;

                if ($statusAccount === 2) :
                    Session::flash('msg', 'Tài khoản của bạn tạm thời đang bị khoá! Vui lòng liên hệ quản trị viên để được hỗ trợ');
                    Session::flash('msg_type', 'danger');
                endif;
            else :
                Session::flash('msg', 'Mật khẩu chưa chính xác');
                Session::flash('msg_type', 'danger');
            endif;
        else :
            Session::flash('msg', 'Email chưa chính xác');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    // Xử lý login
    public function handleEmployerLogin($username, $password)
    {
        $queryGet = $this->handleGetWithRole($username);

        if (!empty($queryGet)) :
            $passwordHash = $queryGet['password'];
            $userId = $queryGet['id'];
            $statusAccount = $queryGet['status'];
            $groupId = $queryGet['group_id'];

            if (password_verify($password, $passwordHash)) :
                $loginToken = sha1(uniqid() . time());

                if ($groupId === 3) :
                    $dataToken = [
                        'company_id' => $userId,
                        'token' => $loginToken,
                        'create_at' => date('Y-m-d H:i:s')
                    ];

                    $tableName = 'companies';
                endif;

                if ($statusAccount === 1) :
                    $insertTokenStatus = $this->db->table('login_token')->insert($dataToken);
                    if ($insertTokenStatus) :
                        // Lưu login token vào session
                        Session::data('login_token_employer', $loginToken);
                        // Lưu thông tin người đăng nhập
                        $this->handleSaveUserData($tableName, $userId);

                        return true;
                    endif;
                endif;

                if ($statusAccount === 0) :
                    Session::flash('msg', 'Vui lòng kích hoạt tài khoản tại Gmail bạn dùng để đăng ký tài khoản');
                    Session::flash('msg_type', 'danger');
                endif;

                if ($statusAccount === 2) :
                    Session::flash('msg', 'Tài khoản của bạn tạm thời đang bị khoá! Vui lòng liên hệ quản trị viên để được hỗ trợ');
                    Session::flash('msg_type', 'danger');
                endif;
            else :
                Session::flash('msg', 'Mật khẩu chưa chính xác');
                Session::flash('msg_type', 'danger');
            endif;
        else :
            Session::flash('msg', 'Email chưa chính xác');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    // Xử lý check: admin, candidates
    public function handleGetWithRole($username)
    {
        $queryGetAdmin = $this->db->table('admins')
            ->select('id, email, password, status, group_id')
            ->where('email', '=', $username)
            ->first();

        $queryGetCandidate = $this->db->table('candidates')
            ->select('id, email, password, status, group_id')
            ->where('email', '=', $username)
            ->first();

        $queryGetEmployer = $this->db->table('companies')
            ->select('id, email, password, status, group_id')
            ->where('email', '=', $username)
            ->first();

        if (!empty($queryGetAdmin)) :
            return $queryGetAdmin;
        endif;

        if (!empty($queryGetCandidate)) :
            return $queryGetCandidate;
        endif;

        if (!empty($queryGetEmployer)) :
            return $queryGetEmployer;
        endif;

        return false;
    }

    // Xử lý lưu data login vào session
    public function handleSaveUserData($role = '', $userId = '')
    {
        $userData = $this->db->table($role)
            ->where('id', '=', $userId)
            ->first();

        if ($role === 'companies') :
            Session::data('employer_data', $userData);
        else :
            Session::data('user_data', $userData);
        endif;
    }

    // Xử lý register
    public function handleRegister()
    {
        $activeToken = sha1(uniqid() . time());
        $groupId = 2;
        $dataInsert = [
            'fullname' => $_POST['fullname'],
            'thumbnail' => 'public/client/assets/images/4259794-200.png',
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'active_token' => $activeToken,
            'group_id' => $groupId,
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = $this->db->table('candidates')->insert($dataInsert);
        if ($insertStatus) :
            // Tạo link active
            $linkActive = _WEB_ROOT . '/active?token=' . $activeToken;
            // Thiết lập mail
            $subject = ucwords($_POST['fullname']) . ' ơi. Bạn vui lòng kích hoạt tài khoản';
            $content = 'Chào bạn: ' . ucwords($_POST['fullname']) . '<br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản của bạn: <br>';
            $content .= $linkActive . '<br>';
            $content .= 'Trân trọng!';

            $sendStatus = Mailer::sendMail($_POST['email'], $subject, $content);

            if ($sendStatus) :
                Session::flash('msg', 'Đăng ký thành công. Email kích hoạt đã được gửi đến bạn!');
                Session::flash('msg_type', 'success');
                return true;
            else :
                Session::flash('msg', 'Hệ thống đang gặp sự cố');
                Session::flash('msg_type', 'danger');
            endif;
        else :
            Session::flash('msg', 'Hệ thống đang gặp sự cố');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    // Xử lý register
    public function handleEmployerRegister()
    {
        $activeToken = sha1(uniqid() . time());
        $groupId = 3;
        $dataInsert = [
            'fullname' => $_POST['fullname'],
            'thumbnail' => 'public/client/assets/images/4259794-200.png',
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'name' => $_POST['company_name'],
            'location' => $_POST['address'],
            'scales' => $_POST['scales'],
            'job_category_id' => $_POST['job_field'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'active_token' => $activeToken,
            'group_id' => $groupId,
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = $this->db->table('companies')->insert($dataInsert);
        if ($insertStatus) :
            // Tạo link active
            $linkActive = _WEB_ROOT . '/ntd/active?token=' . $activeToken;
            // Thiết lập mail
            $subject = ucwords($_POST['fullname']) . ' ơi. Bạn vui lòng kích hoạt tài khoản';
            $content = 'Chào bạn: ' . ucwords($_POST['fullname']) . '<br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản của bạn: <br>';
            $content .= $linkActive . '<br>';
            $content .= 'Trân trọng!';

            $sendStatus = Mailer::sendMail($_POST['email'], $subject, $content);

            if ($sendStatus) :
                Session::flash('msg', 'Đăng ký thành công. Email kích hoạt đã được gửi đến bạn!');
                Session::flash('msg_type', 'success');
                return true;
            else :
                Session::flash('msg', 'Hệ thống đang gặp sự cố');
                Session::flash('msg_type', 'danger');
            endif;
        else :
            Session::flash('msg', 'Hệ thống đang gặp sự cố');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    public function handleActiveAccount($token)
    {
        if (!empty($token)) :
            // Truy vấn sql để so sánh
            $tokenQuery = $this->db->table('candidates')
                ->select('id')
                ->where('active_token', '=', $token)
                ->first();

            if (!empty($tokenQuery)) :
                $userId = $tokenQuery['id'];
                $dataUpdate = [
                    'status' => 1,
                    'active_token' => null
                ];
                $updateStatus = $this->db->table('candidates')->update($dataUpdate, "id = $userId");
                if ($updateStatus) :
                    return true;
                endif;
            endif;
        endif;

        return false;
    }

    public function handleActiveAccountEmployer($token)
    {
        if (!empty($token)) :
            // Truy vấn sql để so sánh
            $tokenQuery = $this->db->table('companies')
                ->select('id')
                ->where('active_token', '=', $token)
                ->first();

            if (!empty($tokenQuery)) :
                $userId = $tokenQuery['id'];
                $dataUpdate = [
                    'status' => 1,
                    'active_token' => null
                ];
                $updateStatus = $this->db->table('companies')->update($dataUpdate, "id = $userId");
                if ($updateStatus) :
                    return true;
                endif;
            endif;
        endif;

        return false;
    }

    public function handleLogout($userId, $groupId)
    {
        if (!empty($groupId) && $groupId === 1) :
            $queryDelete = $this->db->table('login_token')
                ->where('admin_id', '=', $userId)
                ->delete();
        elseif (!empty($groupId) && $groupId === 2) :
            $queryDelete = $this->db->table('login_token')
                ->where('candidate_id', '=', $userId)
                ->delete();
        else :
            $queryDelete = $this->db->table('login_token')
                ->where('company_id', '=', $userId)
                ->delete();
        endif;

        if ($queryDelete && $groupId !== 3) :
            Session::delete('login_token_user');
            Session::delete('user_data');

            return true;
        else :
            Session::delete('login_token_employer');
            Session::delete('employer_data');

            return true;
        endif;

        return false;
    }

    public function handleForgotPassword($email)
    {
        $queryGet = $this->db->table('candidates')
            ->select('fullname, email')
            ->where('email', '=', $email)
            ->first();

        if (!empty($queryGet)) :
            $forgotToken = sha1(uniqid() . time());

            $dataUpdate = [
                'forgot_token' => $forgotToken
            ];

            $insertStatus = $this->db->table('candidates')
                ->where('email', '=', $email)
                ->update($dataUpdate);

            if ($insertStatus) :
                // Tạo link 
                $linkReset = _WEB_ROOT . '/check?token=' . $forgotToken;
                // Thiết lập mail
                $subject = 'ĐẶT LẠI MẬT KHẨU';
                $content = 'Chào bạn: ' . ucwords($queryGet['fullname']) . '<br>';
                $content .= 'Vui lòng click vào link dưới đây để tiến hành đặt lại mật khẩu: <br>';
                $content .= $linkReset . '<br>';
                $content .= 'Nếu không phải là bạn, vui lòng liên hệ cho đội ngũ hỗ trợ. <br>';
                $content .= 'Trân trọng!';

                $sendStatus = Mailer::sendMail($queryGet['email'], $subject, $content);

                if ($sendStatus) :
                    return true;
                else :
                    Session::flash('msg', 'Hệ thống đang gặp sự cố');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;
        else :
            Session::flash('msg', 'Email không tồn tại');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    public function handleForgotPasswordEmployer($email)
    {
        $queryGet = $this->db->table('companies')
            ->select('fullname, email')
            ->where('email', '=', $email)
            ->first();

        if (!empty($queryGet)) :
            $forgotToken = sha1(uniqid() . time());

            $dataUpdate = [
                'forgot_token' => $forgotToken
            ];

            $insertStatus = $this->db->table('companies')
                ->where('email', '=', $email)
                ->update($dataUpdate);

            if ($insertStatus) :
                // Tạo link 
                $linkReset = _WEB_ROOT . '/ntd/check?token=' . $forgotToken;
                // Thiết lập mail
                $subject = 'ĐẶT LẠI MẬT KHẨU';
                $content = 'Chào bạn: ' . ucwords($queryGet['fullname']) . '<br>';
                $content .= 'Vui lòng click vào link dưới đây để tiến hành đặt lại mật khẩu: <br>';
                $content .= $linkReset . '<br>';
                $content .= 'Nếu không phải là bạn, vui lòng liên hệ cho đội ngũ hỗ trợ. <br>';
                $content .= 'Trân trọng!';

                $sendStatus = Mailer::sendMail($queryGet['email'], $subject, $content);

                if ($sendStatus) :
                    return true;
                else :
                    Session::flash('msg', 'Hệ thống đang gặp sự cố');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;
        else :
            Session::flash('msg', 'Email không tồn tại');
            Session::flash('msg_type', 'danger');
        endif;

        return false;
    }

    public function handleConfirmForgotToken($token)
    {
        if (!empty($token)) :
            // Truy vấn sql để so sánh
            $tokenQuery = $this->db->table('candidates')
                ->select('id')
                ->where('forgot_token', '=', $token)
                ->first();

            if (!empty($tokenQuery)) :
                $userId = $tokenQuery['id'];
                $dataUpdate = [
                    'forgot_token' => null
                ];

                $updateStatus = $this->db->table('candidates')
                    ->where('id', '=', $userId)
                    ->update($dataUpdate);

                if ($updateStatus) :
                    $this->db->resetQuery();
                    return $userId;
                endif;
            endif;
        endif;

        return false;
    }

    public function handleResetPassword($userId)
    {
        $queryGet = $this->db->table('candidates')
            ->select('id, fullname, email')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];

            $updateStatus = $this->db->table('candidates')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                $subject = 'ĐẶT LẠI MẬT KHẨU THÀNH CÔNG';
                $content = 'Chào bạn: ' . ucwords($queryGet['fullname']) . '<br>';
                $content .= 'Bạn vừa thay đổi mật khẩu ở Chance. <br>';
                $content .= 'Nếu không phải là bạn, vui lòng liên hệ cho đội ngũ hỗ trợ. <br>';
                $content .= 'Trân trọng!';

                $sendStatus = Mailer::sendMail($queryGet['email'], $subject, $content);

                if ($sendStatus) :
                    return true;
                else :
                    Session::flash('msg', 'Hệ thống đang gặp sự cố');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;
        endif;

        return false;
    }

    public function handleConfirmForgotTokenEmployer($token)
    {
        if (!empty($token)) :
            // Truy vấn sql để so sánh
            $tokenQuery = $this->db->table('companies')
                ->select('id')
                ->where('forgot_token', '=', $token)
                ->first();

            if (!empty($tokenQuery)) :
                $userId = $tokenQuery['id'];
                $dataUpdate = [
                    'forgot_token' => null
                ];

                $updateStatus = $this->db->table('companies')
                    ->where('id', '=', $userId)
                    ->update($dataUpdate);

                if ($updateStatus) :
                    $this->db->resetQuery();
                    return $userId;
                endif;
            endif;
        endif;

        return false;
    }

    public function handleResetPasswordEmployer($userId)
    {
        $queryGet = $this->db->table('companies')
            ->select('id, fullname, email')
            ->where('id', '=', $userId)
            ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];

            $updateStatus = $this->db->table('companies')
                ->where('id', '=', $userId)
                ->update($dataUpdate);

            if ($updateStatus) :
                $subject = 'ĐẶT LẠI MẬT KHẨU THÀNH CÔNG';
                $content = 'Chào bạn: ' . ucwords($queryGet['fullname']) . '<br>';
                $content .= 'Bạn vừa thay đổi mật khẩu ở Chance. <br>';
                $content .= 'Nếu không phải là bạn, vui lòng liên hệ cho đội ngũ hỗ trợ. <br>';
                $content .= 'Trân trọng!';

                $sendStatus = Mailer::sendMail($queryGet['email'], $subject, $content);

                if ($sendStatus) :
                    return true;
                else :
                    Session::flash('msg', 'Hệ thống đang gặp sự cố');
                    Session::flash('msg_type', 'danger');
                endif;
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