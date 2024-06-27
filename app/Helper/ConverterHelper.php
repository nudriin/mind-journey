<?php

namespace Nurdin\Mind\Helper;

require_once __DIR__ . "/../../vendor/autoload.php";

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Block\Paragraph;

class ConverterHelper
{
    public static function convert(): MarkdownConverter
    {
        $config = [
            'default_attributes' => [
                Heading::class => [
                    'class' => static function (Heading $node) {
                        if ($node->getLevel() === 1) {
                            return 'text-2xl font-semibold';
                        } else if ($node->getLevel() === 2) {
                            return 'font-semibold';
                        }
                    },
                ],
                Table::class => [
                    'class' => 'table',
                ],
                Paragraph::class => [
                    'class' => ['text-justify'],
                ],
                Link::class => [
                    'class' => 'btn btn-link',
                    'target' => '_blank',
                ],
            ],
        ];
        
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        
        // Add the extension
        $environment->addExtension(new DefaultAttributesExtension());
        
        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        
        return $converter;
    }
}
