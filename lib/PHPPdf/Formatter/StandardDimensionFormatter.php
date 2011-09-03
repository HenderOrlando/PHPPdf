<?php

/*
 * Copyright 2011 Piotr Śliwa <peter.pl7@gmail.com>
 *
 * License information is in LICENSE file
 */

namespace PHPPdf\Formatter;

use PHPPdf\Formatter\BaseFormatter,
    PHPPdf\Node\Node,
    PHPPdf\Document;

/**
 * Calculates real dimension of node
 *
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class StandardDimensionFormatter extends BaseFormatter
{
    public function format(Node $node, Document $document)
    {
        $parent = $node->getParent();

        if($node->getWidth() === null && $node->getAttribute('display') === Node::DISPLAY_BLOCK && $node->getFloat() === Node::FLOAT_NONE)
        {
            $parentWidth = $parent->getWidthWithoutPaddings();

            $marginLeft = $node->getMarginLeft();
            $marginRight = $node->getMarginRight();

            $node->setWidth($parentWidth - ($marginLeft + $marginRight));
            $node->setRelativeWidth('100%');
        }
        elseif($node->getAttribute('display') === Node::DISPLAY_INLINE)
        {
            $node->setWidth(0);
        }

        if($node->getHeight() === null)
        {
            $node->setHeight(0);
        }

        $paddingLeft = $node->getPaddingLeft();
        $paddingRight = $node->getPaddingRight();
        $paddingTop = $node->getPaddingTop();
        $paddingBottom = $node->getPaddingBottom();
        
        $prefferedWidth = $node->getRealWidth() + $paddingLeft + $paddingRight;
        
        $parent = $node->getParent();
        
        $parentWidth = $parent ? $parent->getWidthWithoutPaddings() : null;
        
        if($parent && $parentWidth < $prefferedWidth)
        {
            $prefferedWidth = $parentWidth;
        }

        $node->setWidth($prefferedWidth);
        $node->setHeight($node->getRealHeight() + $paddingTop + $paddingBottom);
    }
}