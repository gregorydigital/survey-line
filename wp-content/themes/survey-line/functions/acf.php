<?php

    // Register ACF blocks
    function register_acf_blocks() {
        $blocks_dir = get_template_directory() . "/template-parts/blocks";
        $scan = scandir($blocks_dir);

        foreach ($scan as $file) {
            if (is_dir($blocks_dir . "/" . $file) && strpos($file, ".") === false) {
                register_block_type($blocks_dir . "/" . $file);
            }
        }
    }
    add_action("init", "register_acf_blocks");

    // Customize which blocks and patterns are allowed globally (minimal for patterns?)
    add_filter("allowed_block_types_all", function($allowed_blocks, $editor_context) {
        $customBlocks = [];
        $blocks_dir = get_template_directory() . "/template-parts/blocks";
        $scan = scandir($blocks_dir);

        // Collect all custom ACF blocks
        foreach ($scan as $file) {
            if (is_dir($blocks_dir . "/" . $file) && strpos($file, ".") === false) {
                $customBlocks[] = "acf/" . $file;
            }
        }

        // Array of core blocks to always allow (including reusable blocks)
        $alwaysAllowedCoreBlocks = [
            'core/block', // Reusable Blocks
            'core/heading',
            'core/image',
            'core/list',
            'core/list-item',
            'core/paragraph',
            'core/table',
            'core/video',
            'core/quote',
            'core/separator',
        ];

        // Check the post type
        if ($editor_context->post && ($editor_context->post->post_type === 'blog' || $editor_context->post->post_type === 'insight' || $editor_context->post->post_type === 'customer')) {
            // For 'resource' and 'news' post types, allow only specified core blocks
            $allowed_blocks = $alwaysAllowedCoreBlocks;
        } else {
            // For all other post types, allow only custom blocks and reusable blocks
            $allowed_blocks = array_merge($customBlocks, ['core/block']);
        }

        return $allowed_blocks;
    }, 10, 2);


    // Add custom block category
    add_filter("block_categories_all", function($categories, $editor_context) {
        if (!empty($editor_context->post)) {
            // Add custom block category to the top
            array_unshift($categories, [
                "slug" => "custom-block",
                "title" => __("Custom Blocks", "custom-block"),
                "icon" => null,
            ]);
        }
        return $categories;
    }, 10, 2);