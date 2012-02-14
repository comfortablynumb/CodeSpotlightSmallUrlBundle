<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Generator;

class CodeGenerator implements GeneratorInterface
{
    const FROM_BASE = 10;
    const TO_BASE = 36;

    public function generate($id)
    {
        return base_convert($id, self::FROM_BASE, self::TO_BASE);
    }
}
