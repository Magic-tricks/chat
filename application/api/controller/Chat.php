<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;

class Chat extends Controller
{
    /**
     * 文本消息持久化
     */
    public function saveMessage()
    {
        if (Request::instance()->isAjax())
        {
            $message           =   input('post.');

            $datas['fromid']    =   $message['fromid'];
            $datas['fromname']  =   $this->getName($message['fromid']);
            $datas['toid']      =   $message['toid'];
            $datas['toname']    =   $this->getName($message['toid']);
            $datas['content']   =   $message['data'];
            $datas['time']      =   $message['time'];
//            $datas['isread']    =   $message['isread'];
            //发送消息默认为未读
            $datas['isread']    =   0;
            $datas['type']      =   1;

            Db::name('communication')->insert($datas);
        }
    }

    /**
     * 根据用户id返回用户姓名
     */
    public function getName($uid)
    {
       $userInfo    =    Db::name('user')->field('nickname')->find($uid);
       return $userInfo['nickname'];
    }

    /**
     *根据用户ID获取聊天双方头像信息
     */
    public function getHead()
    {
        if (Request::instance()->isAjax())
        {
            $fromId     =   input('fromid');
            $toId       =   input('toid');

            $fromInfo   =   Db::name('user')->field('headimgurl')->find($fromId);
            $toInfo     =   Db::name('user')->field('headimgurl')->find($toId);
            return json([
                'from_head' =>  $fromInfo['headimgurl'],
                'to_head'   =>  $toInfo['headimgurl']
            ]);
        }
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获取用户名称
     */
    public function get_name()
    {
        if (Request::instance()->isAjax())
        {
            $toid    =   input('toid');
            $toInfo  =   Db::name('user')->field('nickname')->find($toid);
            return json(['toName'   =>  $toInfo['nickname']]);
        }
    }

    /**
     *  初始化页面加载返回聊天记录
     */
    public function load()
    {
        if (Request::instance()->isAjax())
        {
            $fromId     =   input('fromid');
            $toId       =   input('toid');

            $count      =   Db::name('communication')
                ->where('(fromid=:fromid and toid=:toid) or (fromid=:toid1 and toid=:fromid1)',['fromid'=>$fromId,'toid'=>$toId,'toid1'=>$toId,'fromid1'=>$fromId])
                ->count('id');
            //计算消息条数，超出则限制，只输出最新十条
            if ($count>=10)
            {
                //查找双方护发的消息
                $message    =   Db::name('communication')
                    ->where('(fromid=:fromid and toid=:toid) or (fromid=:toid1 and toid=:fromid1)',['fromid'=>$fromId,'toid'=>$toId,'toid1'=>$toId,'fromid1'=>$fromId])
                    ->limit($count-10,10)
                    ->order('id')
                    ->select();
            }
            else
            {
                //查找双方护发的消息
                $message    =   Db::name('communication')
                    ->where('(fromid=:fromid and toid=:toid) or (fromid=:toid1 and toid=:fromid1)',['fromid'=>$fromId,'toid'=>$toId,'toid1'=>$toId,'fromid1'=>$fromId])
                    ->order('id')
                    ->select();
            }

            return json($message);
        }
    }

    /**
     * 上传图片，返回图片地址
     */
    public function uploadimg()
    {
        $file   =   $_FILES['file'];
        $fromId =   input('fromid');
        $toId   =   input('toid');
        $online =   input('online');
        //取出文件后缀
        $suffix =   strtolower(strrchr($file['name'],'.'));
        $type   =   ['.jpg','.jpeg','.gif','.png'];
        //指定上传文件类型
        if (!in_array($suffix,$type))
        {
            return json(['status'   =>  'img type error']);
        }
        //指定大小不能超过5M
        if ($file['size']/1024>5120)
        {
            return json(['status'   =>  'img is too large']);
        }
        //生成以chat_img_前缀的唯一文件名
        $fileName   =   uniqid('chat_img_',false);
        //储存路径
        $uploadPath =   ROOT_PATH.'public/static'.DS.'uploads\\';
        //最终路径
        $fileUp     =   $uploadPath.$fileName.$suffix;
        //移动文件
        $re         =   move_uploaded_file($file['tmp_name'],$fileUp);

        if ($re)
        {
            $name   =    $fileName.$suffix;
            $data['content']    =   $name;
            $data['fromid']     =   $fromId;
            $data['toid']       =   $toId;
            $data['fromname']   =   $this->getName($fromId);
            $data['toname']     =   $this->getName($toId);
            $data['time']       =   time();
//            $data['isread']     =   $online;
            //发送消息默认为未读
            $data['isread']     =   0;
            $data['type']       =   2;
            $message_id         =   Db::name('communication')->insertGetId($data);
            if ($message_id)
            {
                return json(['status'   =>  'ok','img_name' =>  $name]);
            }
            else
            {
                return json(['status'   =>  'false']);
            }
        }
    }


    //根据fromid来获取当前用户聊天列表
    public function getList()
    {
        if (Request::instance()->isAjax())
        {
            $fromId     =   input('id');
            $info       =   Db::name('communication')
                ->field('fromid,toid,fromname')
                ->where('toid',$fromId)
                ->group('fromid')
                ->select();
            //循环数组$info，每次处理好的数据返回给$rows
            $rows       =   array_map(function ($res){
                return [
                    'headUrl'  =>  $this->getHeadOne($res['fromid']),
                    'userName' =>   $res['fromname'],
                    'countNoRead'   =>  $this->getCountNoRead($res['fromid'],$res['toid']),
                    'lastMessage'   =>  $this->getLastMessage($res['fromid'],$res['toid'])['content'],
                    'time'          =>  $this->getLastMessage($res['fromid'],$res['toid'])['time'],
                    'chatPage'      =>  "http://www.chat.com/index.php/index/index/index/fromid/{$res['toid']}/toid/{$res['fromid']}"
                ];
            },$info);
            return json($rows);
        }
    }

    /**
     * @param $uid
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 根据uid来获取用户头像
     */
    public function getHeadOne($uid)
    {
        $fromhead       =   Db::name('user')
                                ->field('headimgurl')
                                ->find($uid);
        return  $fromhead['headimgurl'];
    }

    /**
     *根据$fromid来获取和$toid发送的未读消息的总数
     */
    public function getCountNoRead($fromid,$toid)
    {
        return Db::name('communication')
                    ->where(['fromid'=>$fromid,'toid'=>$toid,'isread'=>0])
                    ->count('id');
    }

    /**
     * 根据$fromid和$toid来获取他们聊天的最后一条数据
     */
    public function getLastMessage($fromid,$toid)
    {
        $info   =   Db::name('communication')
                        ->where('(fromid = :fromid && toid=:toid) || (fromid = :fromid2 && toid = :toid2)',['fromid' => $fromid,'toid' =>$toid,'fromid2' => $toid,'toid2' => $fromid])
                        ->order('id desc')
                        ->limit(1)
                        ->find();

        return $info;
    }

    //把所有未读消息设置成已读
    public function changeNoRead()
    {
        if (Request::instance()->isAjax())
        {
            $fromId     =   input('toid');
            $toId       =   input('fromid');
            Db::name('communication')
                ->where(['fromid'  =>  $fromId,'toid'  =>  $toId])
                ->update(['isread'=>1]);

        }
    }

}
