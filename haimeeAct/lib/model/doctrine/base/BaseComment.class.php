<?php

/**
 * BaseComment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $activity_id
 * @property string $content
 * @property timestamp $time
 * @property string $image
 * @property sfGuardUser $User
 * @property Activity $Activity
 * 
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method integer     getActivityId()  Returns the current record's "activity_id" value
 * @method string      getContent()     Returns the current record's "content" value
 * @method timestamp   getTime()        Returns the current record's "time" value
 * @method string      getImage()       Returns the current record's "image" value
 * @method sfGuardUser getUser()        Returns the current record's "User" value
 * @method Activity    getActivity()    Returns the current record's "Activity" value
 * @method Comment     setUserId()      Sets the current record's "user_id" value
 * @method Comment     setActivityId()  Sets the current record's "activity_id" value
 * @method Comment     setContent()     Sets the current record's "content" value
 * @method Comment     setTime()        Sets the current record's "time" value
 * @method Comment     setImage()       Sets the current record's "image" value
 * @method Comment     setUser()        Sets the current record's "User" value
 * @method Comment     setActivity()    Sets the current record's "Activity" value
 * 
 * @package    haimeeAct
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('activity_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('content', 'string', 2550, array(
             'type' => 'string',
             'length' => 2550,
             ));
        $this->hasColumn('time', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('image', 'string', 2550, array(
             'type' => 'string',
             'length' => 2550,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Activity', array(
             'local' => 'activity_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}