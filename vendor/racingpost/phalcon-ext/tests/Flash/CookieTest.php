<?php
namespace Tests\Flash;

class CookieTest extends \Tests\CommonTestCase
{

    const TEST_DOMAIN = '.racingpost.com';
    const TEST_COOKIE = 'flashData';

    private $cookies;
    private $flash;

    public function setUp()
    {
        $_COOKIE[self::TEST_COOKIE] = '[
            {
                "type": "special",
                "message": "Special message",
                "hold": true
            },
            {
                "type": "special",
                "message": "Another message",
                "hold": true
            },
            {
                "type": "success",
                "message": "Another type message",
                "hold": true
            },
            {
                "type": "success",
                "message": "Success message"
            },
            {
                "type": "success",
                "message": "Another success"
            },
            {
                "type": "error",
                "message": "Some error message"
            }
        ]';

        $this->flash = $this->getMockBuilder('\Phalcon\Flash\Cookie')
            ->setConstructorArgs([self::TEST_DOMAIN, self::TEST_COOKIE])
            ->setMethods(['writeData', 'addMessage'])
            ->getMock();
    }

    public function testInitialize()
    {
        $flash = $this->getMockBuilder('\Phalcon\Flash\Cookie')
            ->disableOriginalConstructor()
            ->setMethods(['readData'])
            ->getMock();

        $flash->expects($this->once())
            ->method('readData');

        $flash->__construct(self::TEST_DOMAIN, self::TEST_COOKIE);
    }

    public function testReadData()
    {
        $this->assertEquals(6, sizeof($this->flash->getMessages(false)));
    }

    public function testReadEmptyData()
    {
        unset($_COOKIE[self::TEST_COOKIE]);
        $flash = $this->getMockBuilder('\Phalcon\Flash\Cookie')
            ->setConstructorArgs([self::TEST_DOMAIN, self::TEST_COOKIE])
            ->getMock();

        $this->assertEquals(0, sizeof($flash->getMessages(false)));
    }

    public function testCorruptedData()
    {
        $_COOKIE[self::TEST_COOKIE] = 'Corrupted data';
        $flash = $this->getMockBuilder('\Phalcon\Flash\Cookie')
            ->setConstructorArgs([self::TEST_DOMAIN, self::TEST_COOKIE])
            ->getMock();

        $this->assertEquals(0, sizeof($flash->getMessages(false)));
    }

    public function testAddMessage()
    {
        $_COOKIE[self::TEST_COOKIE] = 'Corrupted data';
        $flash = $this->getMockBuilder('\Phalcon\Flash\Cookie')
            ->setConstructorArgs([self::TEST_DOMAIN, self::TEST_COOKIE])
            ->setMethods(['writeData'])
            ->getMock();

        $flash->expects($this->once())
            ->method('writeData');

        $flash->hold('warning', 'Hello my friend');
    }

    public function testMessage()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with('type', 'Some message');

        $this->flash->message('type', 'Some message');
    }

    public function testNotice()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with(\Phalcon\Flash\Cookie::TYPE_NOTICE, 'Notice message');

        $this->flash->notice('Notice message');
    }

    public function testWarning()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with(\Phalcon\Flash\Cookie::TYPE_WARNING, 'Warning message');

        $this->flash->warning('Warning message');
    }

    public function testSuccess()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with(\Phalcon\Flash\Cookie::TYPE_SUCCESS, 'Success message');

        $this->flash->success('Success message');
    }

    public function testError()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with(\Phalcon\Flash\Cookie::TYPE_ERROR, 'Error message');

        $this->flash->error('Error message');
    }

    public function testHold()
    {
        $this->flash->expects($this->once())
            ->method('addMessage')
            ->with('holdType', 'Error message', true);

        $this->flash->hold('holdType', 'Error message');
    }

    public function testClean()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $this->flash->clean();
        $this->assertEquals(3, sizeof($this->flash->getMessages(false)));
    }

    public function testCleanByType()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $this->flash->clean('success');
        $this->assertEquals(4, sizeof($this->flash->getMessages(false)));
    }

    public function testAutoClean()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $messages = $this->flash->getMessages();
        $this->assertEquals(6, sizeof($messages));
        $this->assertEquals(3, sizeof($this->flash->getMessages(false)));
    }

    public function testCleanAndFilter()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $messages = $this->flash->getMessages(true, 'success');
        $this->assertEquals(3, sizeof($messages));
        $this->assertEquals(4, sizeof($this->flash->getMessages(false)));
    }

    public function testRemoveByType()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $this->flash->removeType('success');
        $this->assertEquals(3, sizeof($this->flash->getMessages(false)));
    }

    public function testRemoveByMessage()
    {
        $this->flash->expects($this->once())
            ->method('writeData');

        $message = $this->flash->getMessages(false)[5];
        $this->flash->removeMessage($message);
        $this->assertEquals(0, sizeof($this->flash->getMessages(false, 'error')));
    }
}
