<?php
declare(strict_types=1);

// DROP TABLE IF EXISTS `t_user`;
// CREATE TABLE `t_user`  (
//   `user_id` int(11) NOT NULL AUTO_INCREMENT,
//   `account` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//   `nick_name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//   `password` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//   `phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
//   `write_time` char(19) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
//   PRIMARY KEY (`user_id`) USING BTREE
// ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


// 数据库操作，无非就是各种花式拼接SQL， 就看谁拼的更优雅
// github上优秀的轮子太多了， 没必要重复造轮子
// 所以 phpRest 使用 \Medoo\Medoo

// see https://medoo.in/doc

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Summary, Param};
use PhpRest2\ApiResult;
use PhpRest2\Database\Medoo;
use DI\Attribute\Inject;

#[Controller('/db')]
class DbController
{
    #[Inject]
    private Medoo $db;

    /***************************************************************************************
     * select 1
     **************************************************************************************/
    #[Action('GET:/find/{userId}')]
    #[Summary('getById')]
    public function getById(int $userId) 
    {
        $row = $this->db->get('t_user', '*', ['user_id' => $userId]);
        if ($row === null) return ApiResult::error('记录不存在');
        // 把数据库里的下划线规则转成驼峰规则
        $row = \App\Utils\Tools::camelizeArrayKey($row);
        return ApiResult::success($row);
    }

    /***************************************************************************************
     * select list
     **************************************************************************************/
    #[Action('GET:/list')]
    #[Summary('getList')]
    public function getList(int $page = 1, int $limit = 10) 
    {        
        $start = ($page-1) * $limit;
        $rows = $this->db->select('t_user', '*', ['LIMIT' => [$start, $limit]]);
        $rows = \App\Utils\Tools::camelizeArrayKey($rows);
        return ApiResult::success($rows);
    }

    /***************************************************************************************
     * insert
     **************************************************************************************/
    #[Action('POST:/')]
    #[Summary('create')]
    #[Param(name: 'account',  rule: 'slug')]
    #[Param(name: 'phone',    rule: '/^1[3456789]\d{9}$/')]
    #[Param(name: 'password', rule: 'lengthBetween=6,20')]
    public function create(string $account, string $phone, string $nickName, string $password) 
    { 
        $data = [
            'account'    => $account,
            'phone'      => $phone,
            'nick_name'  => $nickName,
            'password'   => $password,
            'write_time' => date('Y-m-d H:i:s')
        ];
        
        // https://www.php.net/manual/zh/class.pdostatement.php
        $res = $this->db->insert('t_user', $data);
        if ($res->rowCount() !== 1) return ApiResult::error('添加失败');

        // https://www.php.net/manual/zh/pdo.lastinsertid.php
        $autoId = $this->db->getAutoId();        
        return ApiResult::success("autoId = {$autoId}");
    }

    /***************************************************************************************
     * update
     **************************************************************************************/
    #[Action('PUT:/')]
    #[Summary('update')]
    #[Param(name: 'phone', rule: '/^1[3456789]\d{9}$/')]
    public function update(int $userId, string $nickName, string $phone) 
    { 
        $this->db->update('t_user', [
            'nick_name'  => $nickName,
            'phone'      => $phone
        ], [ 'user_id' => $userId]);
        return ApiResult::success();
    }

    /***************************************************************************************
     * delete
     **************************************************************************************/
    #[Action('DELETE:/{userId}')]
    #[Summary('delete')]
    public function delete(int $userId) 
    { 
        $res = $this->db->delete('t_user', ['user_id' => $userId]);
        if ($res->rowCount() !== 1) return ApiResult::error('删除失败');
        return ApiResult::success();
    }
}
