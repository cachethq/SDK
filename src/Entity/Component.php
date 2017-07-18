<?php

/*
 * This file is part of Cachet SDK.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\SDK\Entity;

/**
 * This is the component entity class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class Component extends AbstractEntity
{
    /**
     * The component id.
     *
     * @var int
     */
    public $id;

    /**
     * The component name.
     *
     * @var string
     */
    public $name;

    /**
     * The component description.
     *
     * @var string
     */
    public $description;

    /**
     * The component link.
     *
     * @var string
     */
    public $link;

    /**
     * The component status.
     *
     * @var int
     */
    public $status;

    /**
     * The component order.
     *
     * @var int
     */
    public $order;

    /**
     * The component group id.
     *
     * @var int
     */
    public $groupId;

    /**
     * The component enabled status.
     *
     * @var bool
     */
    public $enabled;

    /**
     * The component meta.
     *
     * @var array|null
     */
    public $meta;

    /**
     * The component status name.
     *
     * @var string
     */
    public $statusName;

    /**
     * The component tags.
     *
     * @var string[]
     */
    public $tags;

    /**
     * The component created at.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The component updated at.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * The component deleted at.
     *
     * @var string
     */
    public $deletedAt;
}
