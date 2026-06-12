<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'viewer';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => ['title' => 'Super Admin', 'description' => 'Full access to every AnakKayu module.'],
        'admin'      => ['title' => 'Admin', 'description' => 'Manage operational CMS and catalog data.'],
        'editor'     => ['title' => 'Editor', 'description' => 'Review and publish content.'],
        'author'     => ['title' => 'Author', 'description' => 'Create draft articles and pages.'],
        'sales'      => ['title' => 'Sales', 'description' => 'Manage inquiries and customer follow-up.'],
        'viewer'     => ['title' => 'Viewer', 'description' => 'Read-only dashboard access.'],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'dashboard.view'   => 'View dashboard',
        'content.view'     => 'View content',
        'content.create'   => 'Create content',
        'content.update'   => 'Update content',
        'content.delete'   => 'Delete content',
        'content.publish'  => 'Publish content',
        'product.view'     => 'View products',
        'product.create'   => 'Create products',
        'product.update'   => 'Update products',
        'product.delete'   => 'Delete products',
        'service.view'     => 'View services',
        'service.create'   => 'Create services',
        'service.update'   => 'Update services',
        'service.delete'   => 'Delete services',
        'portfolio.view'   => 'View portfolio',
        'portfolio.create' => 'Create portfolio',
        'portfolio.update' => 'Update portfolio',
        'portfolio.delete' => 'Delete portfolio',
        'page.view'        => 'View pages',
        'page.create'      => 'Create pages',
        'page.update'      => 'Update pages',
        'page.delete'      => 'Delete pages',
        'category.view'    => 'View categories',
        'category.create'  => 'Create categories',
        'category.update'  => 'Update categories',
        'category.delete'  => 'Delete categories',
        'media.view'       => 'View media',
        'media.upload'     => 'Upload media',
        'inquiry.view'     => 'View inquiries',
        'inquiry.reply'    => 'Reply/update inquiries',
        'social.import'    => 'Import social references',
        'social.generate'  => 'Generate draft social content',
        'social.review'    => 'Review generated social content',
        'user.view'        => 'View users',
        'user.create'      => 'Create users',
        'user.update'      => 'Update users',
        'user.delete'      => 'Delete users',
        'setting.view'     => 'View settings',
        'setting.update'   => 'Update settings',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => ['*'],
        'admin'      => [
            'dashboard.view', 'content.*', 'product.*', 'service.*', 'portfolio.*',
            'page.*', 'category.*', 'media.*', 'inquiry.*', 'social.*', 'setting.*',
        ],
        'editor'     => ['dashboard.view', 'content.*', 'page.*', 'category.view', 'media.*', 'social.review'],
        'author'     => ['dashboard.view', 'content.view', 'content.create', 'content.update', 'media.upload'],
        'sales'      => ['dashboard.view', 'product.view', 'service.view', 'portfolio.view', 'inquiry.*'],
        'viewer'     => ['dashboard.view', 'content.view', 'product.view', 'service.view', 'portfolio.view', 'inquiry.view'],
    ];
}
