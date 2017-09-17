<?php

namespace Linode\Api\Tests\Helpers;

class Endpoints
{
    public static function disksList()
    {
        return [
            'total_results' => 2,
            'disks' => [
                [
                    'id' => 123456,
                    'label' => 'Ubuntu 14.04 Disk',
                    'status' => 'ok',
                    'size' => 1000,
                    'filesystem' => 'ext4',
                    'created' => '2015-09-29T11:21:01',
                    'updated' => '2015-09-29T11:21:01',
                ],
                [
                    'id' => 123457,
                    'label' => 'Ubuntu 16.04 Disk',
                    'status' => 'ok',
                    'size' => 2000,
                    'filesystem' => 'ext4',
                    'created' => '2015-09-29T11:22:01',
                    'updated' => '2015-09-29T11:22:01',
                ],
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function diskItem(array $replace = [])
    {
        return array_merge([
            'id' => 123456,
            'label' => 'Ubuntu 16.04 Disk',
            'status' => 'ok',
            'size' => 1000,
            'filesystem' => 'ext4',
            'created' => '2015-09-29T11:21:01',
            'updated' => '2015-09-29T11:21:01',
        ], $replace);
    }

    public static function distributionsList()
    {
        return [
            'total_results' => 18,
            'distributions' => [
                [
                    'deprecated' => true,
                    'id' => 'linode/slackware13.37',
                    'x64' => true,
                    'created' => '2011-06-05T19:11:59',
                    'minimum_storage_size' => 600,
                    'label' => 'Slackware 13.37',
                    'vendor' => 'Slackware',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/slackware14.1',
                    'x64' => true,
                    'created' => '2013-11-25T16:11:02',
                    'minimum_storage_size' => 1000,
                    'label' => 'Slackware 14.1',
                    'vendor' => 'Slackware',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/ubuntu14.04lts',
                    'x64' => true,
                    'created' => '2014-04-17T19:42:07',
                    'minimum_storage_size' => 1500,
                    'label' => 'Ubuntu 14.04 LTS',
                    'vendor' => 'Ubuntu',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/centos6.8',
                    'x64' => true,
                    'created' => '2014-04-28T19:19:34',
                    'minimum_storage_size' => 1024,
                    'label' => 'CentOS 6.8',
                    'vendor' => 'CentOS',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/centos7',
                    'x64' => true,
                    'created' => '2014-07-08T14:07:21',
                    'minimum_storage_size' => 1500,
                    'label' => 'CentOS 7',
                    'vendor' => 'CentOS',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/debian7',
                    'x64' => true,
                    'created' => '2014-09-24T17:59:32',
                    'minimum_storage_size' => 600,
                    'label' => 'Debian 7',
                    'vendor' => 'Debian',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/debian8',
                    'x64' => true,
                    'created' => '2015-04-27T20:26:41',
                    'minimum_storage_size' => 1024,
                    'label' => 'Debian 8',
                    'vendor' => 'Debian',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/ubuntu16.04lts',
                    'x64' => true,
                    'created' => '2016-04-22T18:11:29',
                    'minimum_storage_size' => 1024,
                    'label' => 'Ubuntu 16.04 LTS',
                    'vendor' => 'Ubuntu',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/arch2017.07.01',
                    'x64' => true,
                    'created' => '2016-06-13T20:31:34',
                    'minimum_storage_size' => 1800,
                    'label' => 'Arch 2017.07.01',
                    'vendor' => 'Arch',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/slackware14.2',
                    'x64' => true,
                    'created' => '2016-10-13T13:14:34',
                    'minimum_storage_size' => 1700,
                    'label' => 'Slackware 14.2',
                    'vendor' => 'Slackware',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/gentoo2017.07.12',
                    'x64' => true,
                    'created' => '2016-10-25T17:31:25',
                    'minimum_storage_size' => 9000,
                    'label' => 'Gentoo 2017-07-12',
                    'vendor' => 'Gentoo',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/opensuseleap42.2',
                    'x64' => true,
                    'created' => '2016-11-17T19:52:54',
                    'minimum_storage_size' => 1700,
                    'label' => 'openSUSE Leap 42.2',
                    'vendor' => 'openSUSE',
                ],
                [
                    'deprecated' => true,
                    'id' => 'linode/fedora25',
                    'x64' => true,
                    'created' => '2016-11-28T19:53:47',
                    'minimum_storage_size' => 1500,
                    'label' => 'Fedora 25',
                    'vendor' => 'Fedora',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/ubuntu17.04',
                    'x64' => true,
                    'created' => '2017-04-13T20:00:37',
                    'minimum_storage_size' => 1500,
                    'label' => 'Ubuntu 17.04',
                    'vendor' => 'ubuntu',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/containerlinux',
                    'x64' => true,
                    'created' => '2017-06-06T20:44:00',
                    'minimum_storage_size' => 5000,
                    'label' => 'CoreOS Container Linux',
                    'vendor' => 'CoreOS',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/debian9',
                    'x64' => true,
                    'created' => '2017-06-16T20:02:29',
                    'minimum_storage_size' => 1100,
                    'label' => 'Debian 9',
                    'vendor' => 'Debian',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/fedora26',
                    'x64' => true,
                    'created' => '2017-07-12T12:23:15',
                    'minimum_storage_size' => 1500,
                    'label' => 'Fedora 26',
                    'vendor' => 'Fedora',
                ],
                [
                    'deprecated' => false,
                    'id' => 'linode/opensuse42.3',
                    'x64' => true,
                    'created' => '2017-07-27T18:03:05',
                    'minimum_storage_size' => 1900,
                    'label' => 'OpenSUSE Leap 42.3',
                    'vendor' => 'openSUSE',
                ],
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function distributionItem(array $replace = [])
    {
        return array_merge([
            'deprecated' => true,
            'id' => 'linode/slackware13.37',
            'x64' => true,
            'created' => '2011-06-05T19:11:59',
            'minimum_storage_size' => 600,
            'label' => 'Slackware 13.37',
            'vendor' => 'Slackware',
        ], $replace);
    }

    public static function instancesList()
    {
        return [
            'total_results' => 2,
            'linodes' => [
                static::instanceItem(),
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function instanceItem(array $replace = [])
    {
        return array_replace_recursive([
            'id' => 123456,
            'alerts' => [
                'cpu' => ['enabled' => true, 'threshold' => 90],
                'io' => ['enabled' => true, 'threshold' => 10000],
                'transfer_in' => ['enabled' => true, 'threshold' => 10],
                'transfer_out' => ['enabled' => true, 'threshold' => 10],
                'transfer_quota' => ['enabled' => true, 'threshold' => 80],
            ],
            'backups' => [
                'enabled' => true,
                'schedule' => [
                    'day' => 'Tuesday',
                    'window' => 'W20',
                ],
                'last_backup' => [
                    'id' => 123456,
                    'label' => 'A label for your snapshot',
                    'status' => 'successful',
                    'type' => 'snapshot',
                    'region' => ['id' => 'us-east-1a', 'label' => 'Newark, NJ', 'country' => 'USA'],
                    'created' => '2015-09-29T11:21:01',
                    'updated' => '2015-09-29T11:21:01',
                    'finished' => '2015-09-29T11:21:01',
                    'configs' => ['My Debian8 Profile'],
                    'disks' => [
                        'id' => 123456,
                        'label' => 'Ubuntu 14.04 Disk',
                        'status' => 'ok',
                        'size' => 1000,
                        'filesystem' => 'ext4',
                        'created' => '2015-09-29T11:21:01',
                        'updated' => '2015-09-29T11:21:01',
                    ],
                    'availability' => 'daily',
                ],
                'snapshot' => [
                    'id' => 123456,
                    'label' => 'A label for your snapshot',
                    'status' => 'successful',
                    'type' => 'snapshot',
                    'region' => ['id' => 'us-east-1a', 'label' => 'Newark, NJ', 'country' => 'USA'],
                    'created' => '2015-09-29T11:21:01',
                    'updated' => '2015-09-29T11:21:01',
                    'finished' => '2015-09-29T11:21:01',
                ],
            ],
            'created' => '2015-09-29T11:21:01',
            'region' => ['id' => 'us-east-1a', 'label' => 'Newark, NJ', 'country' => 'USA'],
            'distribution' => [
                'deprecated' => true,
                'id' => 'linode/ubuntu14.04lts',
                'x64' => true,
                'created' => '2014-04-17T19:42:07',
                'minimum_storage_size' => 1500,
                'label' => 'Ubuntu 14.04 LTS',
                'vendor' => 'Ubuntu',
            ],
            'group' => 'Example',
            'ipv4' => ['97.107.143.8', '192.168.149.108'],
            'ipv6' => '2a01:7e00::f03c:91ff:fe96:46f5/64',
            'label' => 'Example Linode',
            'status' => 'running',
            'total_transfer' => 20000,
            'updated' => '2015-10-27T09:59:26.000Z',
            'hypervisor' => 'kvm',
        ], $replace);
    }
}
