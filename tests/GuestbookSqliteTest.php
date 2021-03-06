<?php

class GuestbookSqliteTest extends PHPUnit_Extensions_Database_TestCase
{
    private static $pdo = NULL;

    private $conn = NULL;

    //初始化使用的创建Connection
    //通常需要同步创建table结构
    public function getConnection()
    {
        if ($this->conn === NULL) {
            if (self::$pdo === NULL) self::$pdo = new PDO('sqlite::memory:');

            $this->conn = $this->createDefaultDBConnection(self::$pdo, ':memory:');
            self::initTable();
        }

        return $this->conn;
    }

    //创建table结构
    public function initTable()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS `guestbook`  (
            id INT PRIMARY KEY,
            content VARCHAR(50) NOT NULL DEFAULT '',
            user VARCHAR(20) NOT NULL DEFAULT '',
            created VARCHAR(20) NOT NULL DEFAULT ''
            )
        ";

        self::$pdo->query($query);
    }

    /**
     * @test
     */
    public function testGuestBookCount()
    {
        $dataSet = $this->getConnection()->createDataSet();

        $sql = 'SELECT `id` FROM `guestbook`';

        $statement = self::$pdo->prepare($sql);
        $statement->execute();

        if ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            $this->assertEquals(count($result), 3);
        }
    }

    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__). '/guestbook.xml');
    }
}
