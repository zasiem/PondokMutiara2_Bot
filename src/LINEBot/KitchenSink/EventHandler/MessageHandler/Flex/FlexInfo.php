<?php

/**
 * Copyright 2018 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace LINE\LINEBot\KitchenSink\EventHandler\MessageHandler\Flex;

use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentLayout;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;

class FlexInfo
{
    private static $items = [
        '111' => [
            'photo' => 'https://unifiedinfotech.files.wordpress.com/2016/01/programmer_web_development_code_flat_design_vector_illustration_coder_html_website_concept_hands_typing_laptop_objects_desk_worplace.jpg?w=1108&h=737&crop=1',
            'name' => 'Info Kosan',
        ],

        '112' => [
            'photo' => 'https://unifiedinfotech.files.wordpress.com/2016/01/programmer_web_development_code_flat_design_vector_illustration_coder_html_website_concept_hands_typing_laptop_objects_desk_worplace.jpg?w=1108&h=737&crop=1',
            'name' => 'Info Penghuni',
        ],

    ];

    /**
     * Create sample shopping flex message
     *
     * @return \LINE\LINEBot\MessageBuilder\FlexMessageBuilder
     */
    public static function get()
    {
        return FlexMessageBuilder::builder()
            ->setAltText('info')
            ->setContents(new CarouselContainerBuilder([
                self::createItemBubble(111),
                self::createItemBubble(112),
            ]));
    }

    private static function createItemBubble($itemId)
    {
        $item = self::$items[$itemId];
        return BubbleContainerBuilder::builder()
            ->setHero(self::createItemHeroBlock($item))
            ->setBody(self::createItemBodyBlock($item))
            ->setFooter(self::createItemFooterBlock($item));
    }

//gambar
    private static function createItemHeroBlock($item)
    {
        return ImageComponentBuilder::builder()
            ->setUrl($item['photo'])
            ->setSize(ComponentImageSize::FULL)
            ->setAspectRatio(ComponentImageAspectRatio::R20TO13)
            ->setAspectMode(ComponentImageAspectMode::COVER);
    }

//nama
    private static function createItemBodyBlock($item)
    {
        $components = [];
        $desc = [];

        if ($item['name'] == 'Info Kosan') {
           $components[] = TextComponentBuilder::builder()
            ->setText($item['name'])
            ->setWrap(true)
            ->setAlign('center')
            ->setWeight(ComponentFontWeight::BOLD)
            ->setSize(ComponentFontSize::XL);

            $components[] = TextComponentBuilder::builder()
            ->setText('Memberi informasi mengenai kosan Pondok Mutiara 2')
            ->setWrap(true)
            ->setAlign('center')
            ->setSize(ComponentFontSize::XS);

        }else{

            $components[] = TextComponentBuilder::builder()
            ->setText($item['name'])
            ->setWrap(true)
            ->setAlign('center')
            ->setWeight(ComponentFontWeight::BOLD)
            ->setSize(ComponentFontSize::XL);

            $components[] = TextComponentBuilder::builder()
            ->setText('Memberi informasi mengenai penghuni kosan Pondok Mutiara 2')
            ->setWrap(true)
            ->setAlign('center')
            ->setSize(ComponentFontSize::XS);

        }
        

        return BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::VERTICAL)
            ->setSpacing(ComponentSpacing::SM)
            ->setContents($components);

    }

//button
    private static function createItemFooterBlock($item)
    {
        $cartButton = [];
        
        if ($item['name'] == 'Info Kosan') {
            $cartButton[] = ButtonComponentBuilder::builder()
            ->setStyle(ComponentButtonStyle::PRIMARY)
            ->setColor('#f77f00')
            ->setAction(
                new MessageTemplateActionBuilder(
                    'Info Alamat',
                    '/alamat'
                )
            );

            $cartButton[] = ButtonComponentBuilder::builder()
            ->setStyle(ComponentButtonStyle::PRIMARY)
            ->setColor('#f77f00')
            ->setAction(
                new MessageTemplateActionBuilder(
                    'Info ID Listrik',
                    '/listrik'
                )
            );

            $cartButton[] = ButtonComponentBuilder::builder()
            ->setStyle(ComponentButtonStyle::PRIMARY)
            ->setColor('#f77f00')
            ->setAction(
                new MessageTemplateActionBuilder(
                    'Info ID Wifi',
                    '/wifi'
                )
            );

        }else{

            $cartButton[] = ButtonComponentBuilder::builder()
            ->setStyle(ComponentButtonStyle::PRIMARY)
            ->setColor('#f77f00')
            ->setAction(
                new MessageTemplateActionBuilder(
                    'Info Penghuni',
                    '/penghuni'
                )
            );

            $cartButton[] = ButtonComponentBuilder::builder()
            ->setStyle(ComponentButtonStyle::PRIMARY)
            ->setColor('#f77f00')
            ->setAction(
                new MessageTemplateActionBuilder(
                    'Info Iuran Penghuni',
                    '/iuran'
                )
            );

        }

        return BoxComponentBuilder::builder()
            ->setLayout(ComponentLayout::VERTICAL)
            ->setSpacing(ComponentSpacing::SM)
            ->setContents($cartButton);
    }

}
