<?php

namespace Tests;

use Gvera\Helpers\annotations\AnnotationUtil;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class AnnotationUtilTest extends TestCase
{
    /**
     * @test
     * @throws ReflectionException
     */
    public function testHttpMethod()
    {
        $util = new AnnotationUtil();
        $httpMethodAnnotations = $util->getAnnotationContentFromMethod(
            TestAnnotationClass::class,
            "test",
            AnnotationUtil::HTTP_ANNOTATION
        );

        $this->assertNotEmpty($httpMethodAnnotations);


        $httpRequest = new HttpRequest();
        $this->assertTrue($util->validateMethods([], $httpRequest));
        $util->validateMethods(['GET', 'POST'], $httpRequest);
        $nonExistentAnnotations = $util->getAnnotationContentFromMethod(
            TestAnnotationClass::class,
            "test",
            "qwe"
        );
        $this->assertEmpty($nonExistentAnnotations);

        $this->expectException(ReflectionException::class);
        $util->getAnnotationContentFromMethod(TestAnnotationClass::class, "asd", "asd");

    }
}
