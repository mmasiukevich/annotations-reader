<?php

/**
 * PHP Service Bus (publish-subscribe pattern implementation) annotations reader component
 *
 * @author  Maksim Masiukevich <desperado@minsk-info.ru>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace Desperado\ServiceBus\AnnotationsReader;

/**
 * Annotation data
 */
final class Annotation
{
    private const TYPE_CLASS_LEVEL  = 'class_level';
    private const TYPE_METHOD_LEVEL = 'method_level';

    /**
     * Annotation
     *
     * @var object
     */
    public $annotationObject;

    /**
     * Annotation type
     *
     * @see self::TYPE_*
     *
     * @var string
     */
    public $type;

    /**
     * The class containing the annotation
     *
     * @var string
     */
    public $inClass;

    /**
     * Specified if type = method_level
     *
     * @var \ReflectionMethod|null
     */
    public $reflectionMethod;

    /**
     * Creating a method level annotation VO
     *
     * @param \ReflectionMethod $method
     * @param object            $annotation
     * @param string            $inClass
     *
     * @return self
     */
    public static function methodLevel(\ReflectionMethod $method, object $annotation, string $inClass): self
    {
        $self = new self(self::TYPE_METHOD_LEVEL, $annotation, $inClass);

        $self->reflectionMethod = $method;

        return $self;
    }

    /**
     * Creating a method level annotation
     *
     * @param object $annotation
     * @param string $inClass
     *
     * @return self
     */
    public static function classLevel(object $annotation, string $inClass): self
    {
        return new self(self::TYPE_CLASS_LEVEL, $annotation, $inClass);
    }

    /**
     * Is a class-level annotation?
     *
     * @return bool
     */
    public function isClassLevel(): bool
    {
        return self::TYPE_CLASS_LEVEL === $this->type;
    }

    /**
     * Is a method-level annotation?
     *
     * @return bool
     */
    public function isMethodLevel(): bool
    {
        return self::TYPE_METHOD_LEVEL === $this->type;
    }

    /**
     * @param string $type
     * @param object $annotation
     * @param string $inClass
     */
    private function __construct(string $type, object $annotation, string $inClass)
    {
        $this->type             = $type;
        $this->annotationObject = $annotation;
        $this->inClass          = $inClass;
    }
}