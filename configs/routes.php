<?php

// Đường dẫn ảo -> đường dẫn thật
// $routes['default_controller'] = 'client/home';
$routes['/'] = 'client/home';
$routes['trang-chu'] = 'client/home';
$routes['admin'] = 'admin/dashboard/index';


// Route Auth
$routes['dang-nhap'] = 'auth/login';
$routes['dang-ky'] = 'auth/register';
$routes['dang-xuat'] = 'auth/logout';
$routes['active'] = 'auth/active';
$routes['forgot'] = 'auth/forgot';
$routes['check'] = 'auth/check';
$routes['reset'] = 'auth/reset';


/*
    Route trang Client
*/
$routes['tim-viec-lam'] = 'client/job';
$routes['chi-tiet-viec-lam'] = 'client/job/detail';
$routes['chi-tiet-viec-lam/{jobTitle}-(\d+).html'] = 'client/job/detail&id=$1.html';
$routes['chi-tiet-bai-viet'] = 'client/handbook/detail';
$routes['chi-tiet-bai-viet/{handbookTitle}-(\d+).html'] = 'client/handbook/detail&id=$1.html';


$routes['cam-nang'] = 'client/handbook';
$routes['cam-nang/la-ban-su-nghiep'] = 'client/handbook/firstPage';
$routes['cam-nang/tram-sac-ky-nang'] = 'client/handbook/secondPage';
$routes['cam-nang/toa-do-nhan-tai'] = 'client/handbook/thirdPage';
$routes['cam-nang/ki-ot-vui-ve'] = 'client/handbook/fourthPage';
$routes['lien-he'] = 'client/contact';


/*
    Route trang Admin
*/
// Dashboard - Nhóm người dùng
$routes['groups'] = 'admin/group';
$routes['groups/nha-tuyen-dung'] = 'admin/group/getEmployer';
$routes['groups/ung-vien'] = 'admin/group/getCandidate';
$routes['groups/ung-vien/thong-tin'] = 'admin/group/viewProfileCandidate';
$routes['groups/ung-vien/chinh-sua'] = 'admin/group/updateProfileCandidate';
$routes['groups/ung-vien/trang-thai'] = 'admin/group/changeStatusAccountCandidate';
$routes['groups/ung-vien/xoa'] = 'admin/group/deleteCandidate';
$routes['groups/nha-tuyen-dung/thong-tin'] = 'admin/group/viewProfileEmployer';
$routes['groups/nha-tuyen-dung/chinh-sua'] = 'admin/group/updateProfileEmployer';
$routes['groups/nha-tuyen-dung/trang-thai'] = 'admin/group/changeStatusAccountEmployer';
$routes['groups/nha-tuyen-dung/xoa'] = 'admin/group/deleteEmployer';


// Dashboard - Quản lý việc làm
$routes['jobs'] = 'admin/job';
$routes['jobs/danh-sach'] = 'admin/job/getListJob';
$routes['jobs/ho-so-ung-vien'] = 'admin/job/getCandidateProfile';
$routes['jobs/ho-so-ung-vien/trang-thai'] = 'admin/job/changeStatusCandidateProfile';
$routes['jobs/ho-so-ung-vien/xoa'] = 'admin/job/deleteCandidateProfile';
$routes['jobs/ho-so-ung-vien/chinh-sua'] = 'admin/job/editCandidateProfile';
$routes['jobs/ho-so-ung-vien/thong-tin'] = 'admin/job/viewCandidateProfile';
$routes['jobs/ho-so-ung-vien/xem-cv'] = 'admin/job/viewCV';
$routes['jobs/danh-sach/thong-tin'] = 'admin/job/viewJob';
$routes['jobs/danh-sach/trang-thai'] = 'admin/job/changeStatus';
$routes['jobs/danh-sach/chinh-sua'] = 'admin/job/updateJob';
$routes['jobs/danh-sach/xoa'] = 'admin/job/delete';

// Dashboard - Quản lý tin tức nghề nghiệp
$routes['handbooks'] = 'admin/handbook';
$routes['handbooks/danh-sach'] = 'admin/handbook/getListHandbook';
$routes['handbooks/them-moi'] = 'admin/handbook/addHandbook';
$routes['handbooks/danh-sach/thong-tin'] = 'admin/handbook/viewHandbook';
$routes['handbooks/danh-sach/chinh-sua'] = 'admin/handbook/updateHandbook';
$routes['handbooks/danh-sach/xoa'] = 'admin/handbook/delete';
$routes['admin/handbook/getCategory'] = 'admin/handbook/getCategory';
$routes['admin/handbook/getSubCategory'] = 'admin/handbook/getSubCategory';

// Dashboard - Quản lý liên hệ
$routes['contacts'] = 'admin/contact';
$routes['contacts/danh-sach'] = 'admin/contact/getListContact';
$routes['contacts/danh-sach/trang-thai'] = 'admin/contact/changeStatus';
$routes['contacts/danh-sach/xoa'] = 'admin/contact/delete';
$routes['contacts/danh-sach/tra-loi'] = 'admin/contact/reply';

/*
    Route trang user
*/
// Trang người dùng
$routes['doi-mat-khau'] = 'client/profile/changePassword';
$routes['quan-ly-tai-khoan/tai-khoan'] = 'client/profile/editPersonalInformation';
$routes['quan-ly-ho-so/them-ho-so'] = 'client/profile/addPersonalProfile';
$routes['quan-ly-ho-so/ho-so'] = 'client/profile/viewPersonalProfile';
$routes['quan-ly-ho-so/sua-ho-so'] = 'client/profile/editPersonalProfile';
$routes['ung-tuyen'] = 'client/job/recruitment';
$routes['quan-ly-viec-lam/viec-lam-da-ung-tuyen'] = 'client/profile/appliedJob';


// Nhà tuyển dụng
$routes['ntd'] = 'client/employer/index';
$routes['ntd/dang-nhap'] = 'auth/employerLogin';
$routes['ntd/dang-ky'] = 'auth/employerRegister';
$routes['ntd/dang-xuat'] = 'auth/employerLogout';
$routes['ntd/active'] = 'auth/employerActive';
$routes['ntd/forgot'] = 'auth/employerForgot';
$routes['ntd/check'] = 'auth/employerCheck';
$routes['ntd/reset'] = 'auth/employerReset';
$routes['ntd/doi-mat-khau'] = 'client/employer/changePassword';
$routes['ntd/quan-ly-tai-khoan/tai-khoan'] = 'client/employer/editEmployerInformation';
$routes['ntd/quan-ly-dang-tuyen/tao-tin'] = 'client/employer/addJob';
$routes['ntd/quan-ly-dang-tuyen/danh-sach'] = 'client/employer/listJob';
$routes['ntd/quan-ly-dang-tuyen/danh-sach/chinh-sua'] = 'client/employer/updateJob';
$routes['ntd/quan-ly-dang-tuyen/danh-sach/xoa'] = 'client/employer/deleteJob';
$routes['ntd/quan-ly-ung-vien/ho-so-ung-tuyen'] = 'client/employer/appliedJob';
$routes['ntd/quan-ly-ung-vien/ho-so-ung-tuyen/trang-thai'] = 'client/employer/changeStatusAppliedProfile';
$routes['ntd/quan-ly-ung-vien/ho-so-ung-tuyen/gui-email'] = 'client/employer/sendMailApplied';
$routes['ntd/quan-ly-ung-vien/ho-so-ung-tuyen/xem-ho-so'] = 'client/employer/viewProfile';

$routes['admin/doi-mat-khau'] = 'admin/dashboard/changePassword';
