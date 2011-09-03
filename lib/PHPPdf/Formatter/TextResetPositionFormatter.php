<?php

/*
 * Copyright 2011 Piotr Śliwa <peter.pl7@gmail.com>
 *
 * License information is in LICENSE file
 */

namespace PHPPdf\Formatter;

use PHPPdf\Node as Nodes,
    PHPPdf\Document,
    PHPPdf\Util\Point;

/**
 * Calculates text's real dimension
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class TextResetPositionFormatter extends BaseFormatter
{
    public function format(Nodes\Node $node, Document $document)
    {
        $boundary = $node->getBoundary();
        list($x, $y) = $node->getFirstPoint()->toArray();
        $boundary->reset();

        $boundary->setNext($x, $y);
    }
}