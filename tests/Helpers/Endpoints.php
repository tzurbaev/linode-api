<?php

namespace Linode\Api\Tests\Helpers;

class Endpoints
{
    public static function typesList()
    {
        return [
            'total_results' => 3,
            'types' => [
                [
                    'transfer' => 1000,
                    'backup_price' => 2,
                    'vcpus' => 1,
                    'hourly_price' => 0.0075,
                    'ram' => 1024,
                    'monthly_price' => 5,
                    'class' => 'nanode',
                    'mbits_out' => 1000,
                    'storage' => 20480,
                    'id' => 'g5-nanode-1',
                    'label' => 'Linode 1024',
                ],
                [
                    'transfer' => 2000,
                    'backup_price' => 2.5,
                    'vcpus' => 1,
                    'hourly_price' => 0.015,
                    'ram' => 2048,
                    'monthly_price' => 10,
                    'class' => 'standard',
                    'mbits_out' => 1000,
                    'storage' => 30720,
                    'id' => 'g5-standard-1',
                    'label' => 'Linode 2048',
                ],
                [
                    'transfer' => 3000,
                    'backup_price' => 5,
                    'vcpus' => 2,
                    'hourly_price' => 0.03,
                    'ram' => 4096,
                    'monthly_price' => 20,
                    'class' => 'standard',
                    'mbits_out' => 1000,
                    'storage' => 49152,
                    'id' => 'g5-standard-2',
                    'label' => 'Linode 4096',
                ],
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function linodeTypeItem(array $replace = [])
    {
        return array_merge([
            'transfer' => 3000,
            'backup_price' => 5,
            'vcpus' => 2,
            'hourly_price' => 0.03,
            'ram' => 4096,
            'monthly_price' => 20,
            'class' => 'standard',
            'mbits_out' => 1000,
            'storage' => 49152,
            'id' => 'g5-standard-2',
            'label' => 'Linode 4096',
        ], $replace);
    }

    public static function ipAddressesList()
    {
        return [
            'ipv4' => [
                'public' => static::ipAddressV4Item(['type' => 'public']),
                'private' => static::ipAddressV4Item(['type' => 'private']),
                'shared' => static::ipAddressV4Item(['type' => 'shared']),
            ],
            'ipv6' => static::ipAddressV6Item(),
        ];
    }

    public static function ipAddressV4Item(array $replace = [])
    {
        return array_merge([
            'address' => '97.107.143.8',
            'gateway' => '97.107.143.1',
            'subnet_mask' => '255.255.255.0',
            'prefix' => 24,
            'type' => 'public',
            'rdns' => null,
            'linode_id' => 42,
        ], $replace);
    }

    public static function ipAddressV6Item(array $replace = [])
    {
        return array_replace_recursive([
            'addresses' => [
                'address' => '2600:3c01::2:5001',
                'gateway' => 'fe80::1',
                'range' => '2600:3c01::2:5000',
                'rdns' => 'example.org',
                'prefix' => 116,
                'subnet_mask' => 'ffff:ffff:ffff:ffff:ffff:ffff:ffff:f000',
                'type' => 'public',
            ],
            'slaac' => '2a01:7e00::f03c:91ff:fe96',
            'link_local' => 'f300::f03c:91ff:fe96:46da',
            'global' => [
                'range' => '2600:3c01::2:5000/64',
                'region' => 'us-east-1a',
            ],
        ], $replace);
    }

    public static function volumesList()
    {
        return [
            'total_results' => 2,
            'volumes' => [
                static::volumeItem(['id' => 1]),
                static::volumeItem(['id' => 2]),
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function volumeItem(array $replace = [])
    {
        return array_merge([
            'id' => 123,
            'label' => 'my-volume',
            'status' => 'active',
            'size' => 102400,
            'region' => static::regionItem(),
            'created' => '2017-06-20T11:21:01',
            'updated' => '2017-06-20T11:21:01',
        ], $replace);
    }

    public static function configsList()
    {
        return [
            'total_results' => 2,
            'configs' => [
                static::configItem(['id' => 1]),
                static::configItem(['id' => 2]),
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function configItem(array $replace = [])
    {
        return array_merge([
            'id' => 804,
            'comments' => 'Example Linode Configuration',
            'created' => '2015-09-29T11:21:38.000Z',
            'devtmpfs_automount' => true,
            'disks' => [
                'sda' => static::diskItem(),
                'sdb' => 'null',
                'sdc' => 'null',
                'sdd' => 'null',
                'sde' => 'null',
                'sdf' => 'null',
                'sdg' => 'null',
                'sdh' => 'null',
            ],
            'helpers' => [
                'disable_updatedb' => true,
                'enable_distro_helper' => true,
                'enable_modules_dep_helper' => true,
                'enable_network_helper' => true,
            ],
            'initrd' => 'null',
            'kernel' => [
                'id' => 'linode/3.5.2-x86_64-linode26',
                'description' => 'null',
                'xen' => false,
                'kvm' => true,
                'label' => '3.5.2-x86_64-linode26',
                'version' => '3.5.2',
                'x64' => true,
                'current' => true,
                'deprecated' => false,
                'latest' => true,
            ],
            'label' => 'My openSUSE 13.2 Profile',
            'ram_limit' => 512,
            'root_device' => '/dev/sda',
            'root_device_ro' => false,
            'run_level' => 'default',
            'updated' => '2015-09-29T11:21:38.000Z',
            'virt_mode' => 'paravirt',
        ], $replace);
    }

    public static function backupsList()
    {
        return [
            'total_results' => 2,
            'backups' => [
                [
                    'daily' => static::backupItem(),
                    'weekly' => static::backupItem(),
                    'snapshot' => [
                        'current' => static::backupItem(),
                        'in_progress' => static::backupItem(),
                    ],
                ],
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function backupItem(array $replace = [])
    {
        return array_merge([
            'id' => 123456,
            'label' => 'A label for your snapshot',
            'status' => 'successful',
            'type' => 'snapshot',
            'region' => static::regionItem(),
            'created' => '2015-09-29T11:21:01',
            'updated' => '2015-09-29T11:21:01',
            'finished' => '2015-09-29T11:21:01',
            'configs' => ['My Debian8 Profile'],
            'disks' => [
                'id' => 123456,
                'label' => 'Ubuntu 16.04 Disk',
                'status' => 'ok',
                'size' => 1000,
                'filesystem' => 'ext4',
                'created' => '2015-09-29T11:21:01',
                'updated' => '2015-09-29T11:21:01',
            ],
            'availability' => 'daily',
        ], $replace);
    }

    public static function regionsList()
    {
        return [
            'total_results' => 9,
            'regions' => [
                [
                    'id' => 'us-south-1a',
                    'country' => 'us',
                    'label' => 'Dallas, TX',
                ],
                [
                    'id' => 'us-west-1a',
                    'country' => 'us',
                    'label' => 'Fremont, CA',
                ],
                [
                    'id' => 'us-southeast-1a',
                    'country' => 'us',
                    'label' => 'Atlanta, GA',
                ],
                [
                    'id' => 'us-east-1a',
                    'country' => 'us',
                    'label' => 'Newark, NJ',
                ],
                [
                    'id' => 'eu-west-1a',
                    'country' => 'uk',
                    'label' => 'London, UK',
                ],
                [
                    'id' => 'ap-south-1a',
                    'country' => 'sg',
                    'label' => 'Singapore, SG',
                ],
                [
                    'id' => 'eu-central-1a',
                    'country' => 'de',
                    'label' => 'Frankfurt, DE',
                ],
                [
                    'id' => 'ap-northeast-1a',
                    'country' => 'jp',
                    'label' => 'Tokyo, JP',
                ],
                [
                    'id' => 'ap-northeast-1b',
                    'country' => 'jp',
                    'label' => 'Tokyo 2, JP',
                ],
            ],
            'total_pages' => 1,
            'page' => 1,
        ];
    }

    public static function regionItem(array $replace = [])
    {
        return array_merge([
            'id' => 'eu-central-1a',
            'country' => 'de',
            'label' => 'Frankfurt, DE',
        ], $replace);
    }

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
