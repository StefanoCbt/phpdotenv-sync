<?php

namespace Stefanocbt\PhpdotenvSync;

class OperationsStaticReference
{
    /**
     * declaring all operations
     */
    const OPT_DOTENV_CHECK_DIFF = 'check';
    const OPT_DOTENV_SYNC = 'sync';

    /**
     * declaring all operations array
     * (when adding a new operation you have to add an entry inside the following array)
     */
    const OPT_DOTENV_REFERENCES = [
        0 => self::OPT_DOTENV_CHECK_DIFF,
        1 => self::OPT_DOTENV_SYNC,
    ];
}
