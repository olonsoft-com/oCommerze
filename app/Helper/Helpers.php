<?php

use App\Models\Associate;
use App\Models\Department;
use App\Models\Issue;
use App\Models\IssueStateTracking;
use App\Models\Notification;
use App\Models\TeamMember;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Rajtika\Firebase\FirebaseServiceProvider;

// GET Higher Designations

function getHigherDesignation($designations)
{
    $designationArr = array();
    if ($designations) {
        foreach ($designations as $designation) {
            array_push($designationArr, $designation['designation']);
        }
    }

    if (in_array('unit-auditor', $designationArr)) {
        return 'Unit Auditor';
    } elseif (in_array('unit-head', $designationArr)) {
        return 'Head of Unit';
    } elseif (in_array('department-head', $designationArr)) {
        return 'Head of Department';
    } elseif (in_array('employee', $designationArr)) {
        return 'Employee';
    }
    //}
}

/*
* get user higher designation as it is
* Do not Edit it Maruf
* Its for my personal use in API
*/
function getUserHigherDesignation($designations)
{
    if ($designations) {

        $designationArr = array();
        if (count($designations)) {
            foreach ($designations as $designation) {
                array_push($designationArr, $designation['designation']);
            }
        }

        if (in_array('unit-auditor', $designationArr)) {
            return 'unit-audit';
        } elseif (in_array('unit-head', $designationArr)) {
            return 'unit-head';
        } elseif (in_array('department-head', $designationArr)) {
            return 'department-head';
        } elseif (in_array('employee', $designationArr)) {
            return 'employee';
        }
    } else {
        return 'unknown';
    }
}

/**
 * @return string
 */
function getMyRole()
{
    $user = Auth::user();
    if ($user->hasrole(['user', 'User'])) {
        return getHigherDesignation($user->designations);
        //return  $user->designations[0]['designation'];

    } else {
        return $user->hasAnyRole(Role::all()) ? $user->getRoleNames()[0] : 'Unknown';
    }
}

/**
 * getOption
 * @return string
 */
function getOption()
{
    return 'test';
}

/*
 * Update expired issue status
 */

function checkExpiredIssueList()
{

}

/*
 *  Replace Management With BOD
 */
function replaceManagement($role)
{
    if (strtolower($role) == 'management') {
        return 'BOD';
    } else {
        return $role;
    }
}

/*
 * Check role
 */
function isEmployee()
{
    $user = User::with('getDepartmentUnit', 'teams')->find(Auth::user()->id);
    if (strtolower(getHigherDesignation($user->teams)) == 'unit auditor'
        || Auth::user()->hasanyrole('admin|audit|management')) {
        return false;
    } else {
        return true;
    }
}

/*
 * get issue associate list id
 */
function getIssueAssociateListById($id)
{
    $userList = array();
    $associates = Associate::where('issue_id', $id)->get();
    foreach ($associates as $associate) {
        array_push($userList, $associate->user_id);
    }
    return $userList;
}

/**
 * check already issue approved by user or not
 * @param $id
 * @param null $user_id
 * @return bool
 */

function isAlreadyApprovedByUser($id, $user_id = null)
{
    $tracking = IssueStateTracking::where('issue_id', $id)->pluck('user_id')->toArray();
    //dd($tracking);
    if (is_null($user_id)) {
        return (in_array(Auth::user()->id, $tracking)) ? true : false;
    } else {
        return (in_array($user_id, $tracking)) ? true : false;
    }
}

/*
 * get issue associate list id
 */
function canComment($id)
{
    // $flag = false;
    $issue = Issue::with(['unit_auditor', 'unit_head', 'department_head', 'unit', 'department', 'lastState'])
        ->find($id);
    //dd($issue);
    //exit;
    if ($issue) {
        if (
            $issue->creator_id != Auth::user()->id &&
            in_array($issue->status, ['opened', 'in-progress']) &&
            (
                ($issue->assignee_id == Auth::user()->id) ||
                in_array(Auth::user()->id, getIssueAssociateListById($issue->id))
            )
        ) {
            $flag = true;
        } elseif (
            in_array($issue->status, ['opened', 'in-progress', 'done']) &&
            $issue->department_head['id'] == Auth::user()->id &&
            in_array($issue->lastState['designation'], ['assignee'])
        ) {
            $flag = true;
        } elseif (
            in_array($issue->status, ['opened', 'in-progress', 'done']) &&
            $issue->unit_head['id'] == Auth::user()->id &&
            in_array($issue->lastState['designation'], ['assignee', 'department-head'])
        ) {
            $flag = true;
        } elseif (
            in_array($issue->status, ['opened', 'in-progress', 'done']) &&
            $issue->unit_auditor['id'] == Auth::user()->id &&
            in_array($issue->lastState['designation'], ['assignee', 'department-head', 'unit-head'])
        ) {
            $flag = true;
        } elseif (
            Auth::user()->hasanyrole('audit') &&
            in_array($issue->lastState['designation'], ['assignee', 'department-head', 'unit-head', 'unit-auditor']) &&
            ($issue->lastState['designation'] != 'management') &&
            !in_array($issue->status, ['completed', 'rejected'])

        ) {
            $flag = true;
        } elseif (
            Auth::user()->hasanyrole('management') &&
            in_array($issue->lastState['designation'],
                ['assignee', 'department-head', 'unit-head', 'unit-auditor', 'audit']) &&
            !in_array($issue->status, ['completed', 'rejected'])
        ) {
            $flag = true;
        } else {
            $flag = false;
        }
    }

    return $flag;

}


/*
 *  get user id form  issue related anywhere
 */

function getUserIdAnyWhereFromIssue($id)
{
    $userIds = array();
    $issue = Issue::with('assignee', 'creator', 'unit_head', 'unit_auditor', 'department_head', 'associates')
        ->where('id', $id)
        ->first();
    array_push($userIds, $issue->creator_id);
    array_push($userIds, $issue->assignee_id);
    //array_push($userIds,$issue->department_head['id']); // dept head when creating issue , Ex dept head
    //array_push($userIds,$issue->unit_head['id']); // unit head when creating issue , Ex unit head
    //array_push($userIds,$issue->unit_auditor['id']); // unit auditor when creating issue , Ex unit Auditor
    foreach ($issue->associates as $associate) {
        array_push($userIds, $associate->user_id);
    }

    // New unit head
    $unitHead = Unit::where(['id' => $issue->unit_id, 'unit_head_id' => Auth::user()->id])->first();
    if ($unitHead) {
        array_push($userIds, Auth::user()->id);
    }

    // New unit auditor
    $unitAuditor = Unit::where(['id' => $issue->unit_id, 'unit_auditor_id' => Auth::user()->id])->first();
    if ($unitAuditor) {
        array_push($userIds, Auth::user()->id);
    }

    // New department head
    $deptHead = Department::where(['id' => $issue->department_id, 'department_head_id' => Auth::user()->id])->first();
    if ($deptHead) {
        array_push($userIds, Auth::user()->id);
    }

    // admin management audit
    $allUsers = User::where('status', '1')->get();
    foreach ($allUsers as $user) {
        if ($user->hasanyrole('admin|management|audit')) {
            array_push($userIds, $user->id);
        }
    }

    return $userIds;

}

/*
 * Check value exist in array or not
 */
function checkValueExistOrNot($array, $value)
{
    if (count($array) > 0 && in_array($value, $array)) {
        return true;
    }
    return false;
}


//get role
function getRoleById($id)
{
    $user = User::find($id);
    if ($user->hasrole('admin')) {
        return 'admin';
    } else if ($user->hasrole('management')) {
        return 'management';
    } else if ($user->hasrole('audit')) {
        return 'audit';
    } else if ($user->hasrole('unit-head')) {
        return 'unit-head';
    } else if ($user->hasrole('department-head')) {
        return 'department-head';
    } else if ($user->hasrole('associate')) {
        return 'associate';
    } else if ($user->hasrole('assignee')) {
        return 'assignee';
    }
}


function getUserListByUnitId($ids)
{
    $users = TeamMember::whereIn('unit_id', $ids)
        ->where('user_id', '!=', Auth::user()->id)
        ->pluck('user_id');

    return $users;
}

function getUserListByDepartmentId($ids)
{
    $users = TeamMember::whereIn('department_id', $ids)
        ->where('user_id', '!=', Auth::user()->id)
        ->pluck('user_id');

    return $users;
}



function getUnitDetailsByUserId($id)
{
    $myObj = new stdClass;
    $unit = Unit::where('unit_head_id', $id)->orderBy('id', 'desc')->first();

    if ($unit) {
        $myObj->hasResult = 1;
        $myObj->unit = $unit;
    } else {
        $myObj->hasResult = 0;
    }
    return $myObj;
}

function getAllUser()
{
    if ((Auth::user()->hasanyrole('admin|management|audit'))) {
        $users = User::with('info')
            ->where('id', '!=', Auth::user()->id)
            ->get();

        foreach ($users as $user) {
            if ($user->info['avatar'] == 'avatar.png') {
                $user->info['avatar'] = 'uploads/avatar/avatar.png';
            }
            if ($user->info['cover'] == 'cover.png') {
                $user->info['cover'] = 'uploads/cover/cover.png';
            }
            $user->isOnline = isUserOnline($user->id);
        }
        return $users;
    }

    $data['totalUser'] = [];
    $data['onlineUser'] = [];
    $user = User::with('getDepartmentUnit')->find(Auth::user()->id);
    $unitIds = array();
    if ($user->available_units) {
        foreach ($user->available_units as $unit) {
            array_push($unitIds, $unit['unit_id']);
        }
    }

    $departmentIds = array();
    if ($user->available_departments) {
        foreach ($user->available_departments as $department) {
            array_push($departmentIds, $department['department_id']);
        }
    }

    if (count($departmentIds)) {
        $data['totalUser'] = TeamMember::with('user.info')
            ->whereIn('department_id', $departmentIds)
            ->get();
    } elseif (count($unitIds)) {
        $data['totalUser'] = TeamMember::with('user.info')
            ->whereIn('unit_id', $unitIds)
            ->get();
    }

    // return($data['totalUser']);
    if (count($data['totalUser']) > 0) {
        foreach ($data['totalUser'] as $online) {
            $online->user['isOnline'] = isUserOnline($online->user['id']);
            if ($online->user['info']['avatar'] == 'avatar.png') {
                $online->user['info']['avatar'] = 'uploads/avatar/avatar.png';
            }
            if ($online->user['info']['cover'] == 'cover.png') {
                $online->user['info']['cover'] = 'uploads/cover/cover.png';
            }
            if ($online->user['id'] != Auth::user()->id) {
                array_push($data['onlineUser'], $online->user);
            }
        }
    }

    return ($data['onlineUser']);
}

function isUserOnline($id)
{
    return Cache::has('user-is-online-' . $id);
}


/**
 * @param string $type
 * @param $issue_id
 * @param $sender_id
 * @param $receiver_id
 * @param $title
 * @param $message
 * @return bool
 */
function sendNotification($type = 'issue', $issue_id, $sender_id, $receiver_id, $title, $message)
{
    $notification = new Notification();
    $notification->issue_id = $issue_id;
    $notification->receiver_id = $receiver_id;
    $notification->sender_id = $sender_id;
    $notification->type = $type;
    $notification->title = $title;
    $notification->message = $message;
    $result = $notification->save();

    if ($result) {
        //push notification to assignee
        $receiver = User::find($receiver_id);
        if ($receiver) {
            if ($receiver->device_token != null) {
                $firebase = new Firebase();
                $firebase->setID($result);
                $firebase->setIssueID($issue_id);
                $firebase->toOne($receiver->device_token);
                $firebase->setTitle($title);
                $firebase->setBody($message);
                $firebase->send();
            }
            return true;
        } else {
            return false;
        }
    }

    return false;
}


//notification seen status update
/**
 * @param $id
 * @return mixed
 */
function seenStatusUpdate($id)
{
    $notification = Notification::find($id);
    $notification->seen = 'true';
    return $notification->save();
}


/**
 * @param $length
 * @return string
 * @throws Exception
 */
function randomAlphaNumericString($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnpqrstuvwxyz";
    $codeAlphabet .= "123456789";
    $max = strlen($codeAlphabet);
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }
    return $token;
}


//get specific unit
/**
 * @param $id
 * @return mixed
 */
function getUnitById($id)
{
    $unit = \App\Models\Unit::find($id);
    return $unit;
}


//get specific unit
function getDepartmentById($id)
{
    $department = Department::find($id);
    return $department;
}


//get specific unit
function getDepartmentListByUnitId($id)
{
    if (!empty($id) && isset($id)) {
        $department = Department::where('unit_id', $id)->pluck('name', 'id');
        return $department;
    }
}


//get unit-auditor
function getUnitAuditorByUnitId($id)
{
    $unitAuditor = TeamMember::where(['designation' => 'unit-auditor', 'unit_id' => $id])->first();
    if (!empty($unitAuditor)) {
        return $unitAuditor->user_id;
    }
    return 0;
}


//setting Issue status color
function getIssueStatusColor($status)
{
    if ($status == 'assigned')
        echo '<span class="text-purple text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    elseif ($status == 'opened') {

        echo '<span class="text-info text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    } elseif ($status == 'in-progress')
        echo '<span class="text-lightpurple text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    elseif ($status == 'done')
        echo '<span class="text-indigo text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    elseif ($status == 'completed')
        echo '<span class="text-success text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    elseif ($status == 'rejected')
        echo '<span class=" text-danger  text-bold p-2" style="font-size: 15px">' . ucfirst($status) . '</span>';
    else
        echo '<span class="text-warning p-2 text-bold" style="font-size: 15px">' . ucfirst($status) . '</span>';

}


//get time in specific format
function timeFormatting($val)
{
    $time = strtotime($val);
    return date('h:i A   d-M-Y', $time);

}

//size
function formatFileSizeUnits($size)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1000)) : 0;
    return number_format($size / pow(1000, $power), 2, '.', ',') . ' ' . $units[$power];
}

/*
     * for attachment files
     */
///for chat feature increase
function formatUrlsInText($string)
{
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

// The Text you want to filter for urls
    $text = $string;

// Check if there is a url in the text
    if (preg_match($reg_exUrl, $text, $url)) {

        // make the urls hyper links
        echo preg_replace($reg_exUrl, '<a href="' . $url[0] . '" target="_blank"  rel="nofollow"  data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="' . $url[0] . '">' . $url[0] . '</a>', $text);

    } else {

        // if no urls in the text just return the text
        echo $text;

    }
}


function formattingAttachment($filename, $extension)
{
    $supportedImageExtension = array('jpeg', 'jpg', 'png', 'gif');
    $supportedOfficeFilesExtension = array('pdf', 'docx', 'doc', 'xls', 'xlsx');
    //$data='';
    if (in_array($extension, $supportedImageExtension)) {
        $data = '<a href="' . url('/' . $filename) . '" target="_blank"><img src="' . url('/' . $filename) . '" style="overflow:auto; height:100px;min-width:150px;" class="img-thumbnail"></a>';
    } //else if (in_array($extension, $supportedImageExtension))
    else {
        $data = '<a href="' . url('/' . $filename) . '" target="_blank" ><img src="' . url('/images/unknown_file.jpg') . '" style="overflow:auto; height:100px;min-width:150px;" class="img-thumbnail"></a>';
    }

    return html_entity_decode($data);
}

function chattingGroup($issue)
{
    //Create Chat Group
    DB::table('mad_groups')
        ->insert([
            'id' => $issue->id,
            'name' => $issue->title,
            'date' => DateJacky(),
            'userID' => Auth::user()->id
        ]);

    $groupId = $issue->id;

    //generate Notification Key
    $firebase = new Firebase;
    $notification_key = $firebase->generateKey($groupId);

    //add Users to Chat Users table
    if (!checkChatUser(Auth::user()->id)) {
        DB::table('mad_users')
            ->insert([
                'id' => Auth::user()->id,
                'username' => Auth::user()->name,
                'phone' => Auth::user()->mobile,
                'country' => 'Bangladesh',
                'is_activated' => Auth::user()->status,
                'status_date' => time(),
                'auth_token' => $firebase->generateKey(Auth::user()->id),
                'registered_id' => (Auth::user()->device_token != null) ? Auth::user()->device_token : null
            ]);

    }

    //update notification key to group
    DB::table('mad_groups')
        ->where('id', $groupId)
        ->update(['notification_key' => $notification_key]);

    //add group admin to group members
    DB::table('mad_group_members')
        ->insert([
            'groupID' => $groupId,
            'userID' => Auth::user()->id,
            'role' => 'admin'
        ]);

    $groupMembers[] = (Auth::user()->device_token != null) ? Auth::user()->device_token : '';

    //add group members to Group Members Table
    if ($issue->associates) {
        foreach ($issue->associates as $associate) {

            //add Users to Chat Users table
            if (!checkChatUser($associate['user_id'])) {
                DB::table('mad_users')
                    ->insert([
                        'id' => $associate['user_id'],
                        'username' => $associate['user']['name'],
                        'phone' => $associate['user']['mobile'],
                        'country' => 'Bangladesh',
                        'is_activated' => $associate['user']['status'],
                        'status_date' => time(),
                        'auth_token' => $firebase->generateKey($associate['user_id']),
                        'registered_id' => $associate['user']['device_token']
                    ]);

            }

            if (Auth::user()->id != $associate['user_id']) {
                if (!checkChatGroupMember($groupId, $associate['user_id'])) {
                    DB::table('mad_group_members')
                        ->insert([
                            'groupID' => $groupId,
                            'userID' => $associate['user_id'],
                            'role' => 'member'
                        ]);
                }

                //add groupMembers[] too
                if ($associate['user']['device_token'] != null)
                    array_push($groupMembers, $associate['user']['device_token']);
            }

            //send push notification

        }
    }

    //add department head to the group members
    $departmentHead = \App\Models\TeamMember::with('user')->where(['department_id' => $issue->department_id, 'designation' => 'department-head'])->first();
    if ($departmentHead) {
        if (!checkChatGroupMember($groupId, $departmentHead->user_id)) {
            DB::table('mad_group_members')
                ->insert([
                    'groupID' => $groupId,
                    'userID' => $departmentHead->user_id,
                    'role' => 'member'
                ]);
        }

        //add groupMembers[] too
        if ($departmentHead->user['device_token'] != null)
            array_push($groupMembers, $departmentHead->user['device_token']);
    }

    //add Unit head to the group members
    $unitHead = \App\Models\TeamMember::with('user')->where(['unit_id' => $issue->unit_id, 'designation' => 'unit-head'])->first();
    if ($unitHead) {
        if (!checkChatGroupMember($groupId, $unitHead->user_id)) {
            DB::table('mad_group_members')
                ->insert([
                    'groupID' => $groupId,
                    'userID' => $unitHead->user_id,
                    'role' => 'member'
                ]);
        }

        //add groupMembers[] too
        if ($unitHead->user['device_token'] != null)
            array_push($groupMembers, $unitHead->user['device_token']);
    }


    //add Unit Audit to the group members
    $unitAuditor = \App\Models\TeamMember::with('user')->where(['unit_id' => $issue->unit_id, 'designation' => 'unit-auditor'])->first();
    if ($unitAuditor) {
        if (!checkChatGroupMember($groupId, $unitAuditor->user_id)) {
            DB::table('mad_group_members')
                ->insert([
                    'groupID' => $groupId,
                    'userID' => $unitAuditor->user_id,
                    'role' => 'member'
                ]);
        }

        //add groupMembers[] too
        if ($unitAuditor->user['device_token'] != null)
            array_push($groupMembers, $unitAuditor->user['device_token']);
    }

    //add Management / Audit to the group members
    $managements = User::whereHas('roles', function ($q) {
        $q->whereIn('name', ['management', 'audit']);
    })->get();

    if ($managements) {
        foreach ($managements as $management) {
            if (!checkChatGroupMember($groupId, $management->id)) {
                DB::table('mad_group_members')
                    ->insert([
                        'groupID' => $groupId,
                        'userID' => $management->id,
                        'role' => 'member'
                    ]);
            }

            //add groupMembers[] too
            if ($management->device_token != null)
                array_push($groupMembers, $management->device_token);
        }
    }

    //Add BatchGroup and Members to Firebase API
    $response = $firebase->batchAdd($groupMembers);
}

function addGroupMember($groupId, $user, $role = 'member')
{

}

function canCreateIssue($designations = '')
{
    if ($designations == null) {
        $user = User::with('designations')->find(Auth::user()->id);
        $designations = $user->designations;
    }

    $canCreate = 0;
    if (count($designations)) {
        foreach ($designations as $designation) {
            if ($designation['can_create'] == 1)
                $canCreate = 1;
        }
    }

    return $canCreate;
}

function is_issue_expired($issue)
{
    if ($issue->status == 'expired') {
        return true;
    } elseif (in_array($issue->status, array('assigned', 'opened'))) {
        return (date('Y-m-d', strtotime($issue->endDate)) < date('Y-m-d')) ? true : false;
    } else {
        return false;
    }
}

function checkChatUser($userId)
{
    $user = DB::table('mad_users')->where('id', $userId)->first();

    return ($user) ? true : false;
}

function checkChatGroupMember($groupId, $userId)
{
    $user = DB::table('mad_group_members')->where(['groupID' => $groupId, 'userID' => $userId])->first();

    return ($user) ? true : false;
}

function DateJacky()
{
    //$date = strtotime($dt);
    //
    // $date = new DateTime();

    // $time_dd = date("d", $date);
    // $time_MM = date("M", $date);
    // $now = time();
    // $c_dd = date("d", $now);
    // $c_MM = date("M", $now);
    // if ($time_MM == $c_MM) {
    //     if ($time_dd == $c_dd) {
    //         //days
    //         $newFormat = date('H:i', $date);
    //         return $newFormat;
    //     } else if ($time_dd == $c_dd - 1) {
    //         //yesterday
    //         $yesterday = 'Yesterday ';
    //         $newFormat = date('H:i', $date);
    //         return $yesterday . '' . $newFormat;
    //     } else if ($time_dd > $c_dd - 6 && $time_dd < $c_dd - 1) {
    //         //week
    //         $newFormat = date('l H:i', $date);
    //         return $newFormat;
    //     } else {
    //         //month
    //         $newFormat = date('D M H:i', $date);
    //         return $newFormat;
    //     }
    // }
    // //month
    // $newFormat = date('D M Y', $date);
    // return $newFormat;

    return date('Y-m-d') . 'T17:06:25.701+06:00';
}