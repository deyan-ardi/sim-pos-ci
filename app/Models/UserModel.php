<?php namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = User::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at','user_image', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at', 'user_number'
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $afterInsert = ['addToGroup'];

    /**
     * The id of a group to assign.
     * Set internally by withGroup.
     * @var int
     */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     *
     * @param string      $email
     * @param string|null $token
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function logResetAttempt(string $email, string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email' => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     *
     * @param string|null $token
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function logActivationAttempt(string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Sets the group to assign any users created.
     *
     * @param string $groupName
     *
     * @return $this
     */
    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    public function clearGroup()
    {
        $this->assignGroup = null;

        return $this;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup))
        {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }

    public function getUserRole($id = null, $role = null)
    {
        if ($id == null && $role != null) {
            $this->select('users.id as userid,auth_groups_users.id as groupid,user_image, username,user_number, email, name,updated_at, password_hash,active');
            $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            return $this->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->where('auth_groups_users.group_id', $role)->get()->getResultArray();
        }else if($id == null) {
            $this->select('users.id as userid,user_image, auth_groups_users.id as groupid,username,user_number, email, name, password_hash,updated_at,active');
            $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            return $this->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->get()->getResult();
        } else if ($id != null) {
            $this->select('users.id as userid,user_image,auth_groups_users.id as groupid, username,user_number, email, name, password_hash,updated_at,active');
            $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            return $this->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->where('users.id', $id)->get()->getResultArray();
        }
    }
}