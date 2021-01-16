<?php

namespace Ebcms;

use LogicException;

class IncludeWrapper
{
    public function load(string $code): string
    {
        if (!strlen($code)) {
            throw new LogicException('code can not be empty!');
        }

        if (!in_array('include', stream_get_wrappers())) {
            stream_wrapper_register('include', '\\Ebcms\\IncludeStream');
        }

        $filename = uniqid();
        file_put_contents('include://' . $filename, $code);
        return 'include://' . $filename;
    }
}
