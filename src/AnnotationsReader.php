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
 * Annotation extractor
 */
interface AnnotationsReader
{
    /**
     * Extract class/method level annotations
     *
     * @param string $class
     *
     * @return AnnotationCollection
     *
     * @throws \Desperado\ServiceBus\AnnotationsReader\Exceptions\ParseAnnotationFailed
     */
    public function extract(string $class): AnnotationCollection;
}

