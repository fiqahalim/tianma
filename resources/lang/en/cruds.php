<?php

return [
    'userManagement' => [
        'title'          => 'User Management',
        'title_singular' => 'User Management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Agents',
        'title_singular' => 'Agent',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'name'                        => 'Full Name',
            'name_helper'                 => ' ',
            'email'                       => 'Email',
            'email_helper'                => ' ',
            'email_verified_at'           => 'Email verified at',
            'email_verified_at_helper'    => ' ',
            'password'                    => 'Password',
            'password_helper'             => ' ',
            'roles'                       => 'Roles',
            'roles_helper'                => ' ',
            'remember_token'              => 'Remember Token',
            'remember_token_helper'       => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'id_number'                   => 'New NRIC / Passport',
            'id_number_helper'            => ' ',
            'username'                    => 'Username',
            'username_helper'             => ' ',
            'contact_no'                  => 'Contact No',
            'contact_no_helper'           => ' ',
            'agent_code'                  => 'Agent Code',
            'agent_code_helper'           => ' ',
            'approved'                    => 'Approved',
            'approved_helper'             => ' ',
            'verified'                    => 'Verified',
            'verified_helper'             => ' ',
            'verified_at'                 => 'Verified at',
            'verified_at_helper'          => ' ',
            'verification_token'          => 'Verification token',
            'verification_token_helper'   => ' ',
            'parent'                      => 'Parent ID',
            'parent_helper'               => ' ',
            'id_type'                     => 'ID Type',
            'id_type_helper'              => ' ',
            'passport_issue_date'         => 'Passport Issue Date',
            'passport_issue_date_helper'  => ' ',
            'passport_expiry_date'        => 'Passport Expiry Date',
            'passport_expiry_date_helper' => ' ',
            'address_1'                   => 'Address 1',
            'address_1_helper'            => ' ',
            'address_2'                   => 'Address 2',
            'address_2_helper'            => ' ',
            'postcode'                    => 'Postcode',
            'postcode_helper'             => ' ',
            'state'                       => 'State',
            'state_helper'                => ' ',
            'city'                        => 'City',
            'city_helper'                 => ' ',
            'country'                     => 'Country',
            'country_helper'              => ' ',
            'nationality'                 => 'Nationality',
            'nationality_helper'          => ' ',
            'team'                        => 'Agency Code',
            'team_helper'                 => ' ',
            'ref_name'                    => 'Referral Agent Code',
            'ref_name_helper'             => ' ',
            'hierarchy'                   => 'My Hierarchy',
            'hierarchies'                 => 'Hierarchy',
            'change_image'                => 'Change Profile',
        ],
    ],
    'productManagement' => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'productCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Category Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
        ],
    ],
    'product' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'description'              => 'Product Description',
            'description_helper'       => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'slug'                     => 'Slug',
            'slug_helper'              => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'category'                 => 'Categories',
            'category_helper'          => ' ',
            'tag'                      => 'Tags',
            'tag_helper'               => ' ',
            'product_name'             => 'Product Name',
            'product_name_helper'      => ' ',
            'product_id_number'        => 'Product ID Number',
            'product_id_number_helper' => ' ',
            'product_code'             => 'Product Code',
            'product_code_helper'      => 'e.g.: SKV1276',
            'price'                    => 'Price',
            'price_helper'             => ' ',
            'selling_price'            => 'Selling Price',
            'selling_price_helper'     => ' ',
            'maintenance_price'        => 'Maintenance Price',
            'maintenance_price_helper' => ' ',
            'list_price'               => 'List Price',
            'list_price_helper'        => ' ',
            'total_cost'               => 'Total Cost',
            'total_cost_helper'        => ' ',
            'quantity_per_unit'        => 'Quantity Per Unit',
            'quantity_per_unit_helper' => ' ',
            'point_value'              => 'Point Value',
            'point_value_helper'       => ' ',
            'promotion_price'          => 'Promotion Price',
            'promotion_price_helper'   => '',
        ],
    ],
    'productTag' => [
        'title'          => 'Product Tag',
        'title_singular' => 'Product Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Tag Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'lotLayout' => [
        'title_singular' => 'Layout',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Layouts',
            'name_helper'       => ' ',
        ],
    ],
    'documentManagement' => [
        'title'          => 'Document Management',
        'title_singular' => 'Document Management',
    ],
    'myDocument' => [
        'title'          => 'My Document',
        'title_singular' => 'My Document',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'document_file'        => 'Document File',
            'document_file_helper' => ' ',
            'document_name'        => 'Document Name',
            'document_name_helper' => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'agents'               => 'Agents',
            'agents_helper'        => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'Annoucements',
        'title_singular' => 'Annoucement',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'attachment'        => 'Attachment',
            'attachment_helper' => ' ',
        ],
    ],
    'customer' => [
        'title'          => 'Customer',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'full_name'                  => 'Full Name',
            'full_name_helper'           => ' ',
            'id_number'                  => 'New NRIC / Passport',
            'id_number_helper'           => ' ',
            'email'                      => 'Contact Person Email',
            'email_helper'               => ' ',
            'contact_person_name'        => 'Contact Person Name',
            'contact_person_name_helper' => ' ',
            'contact_person_no'          => 'Contact Person No',
            'contact_person_no_helper'   => ' ',
            'birth_date'                 => 'Birth Date',
            'birth_date_helper'          => ' ',
            'postcode'                   => 'Postcode',
            'postcode_helper'            => ' ',
            'state'                      => 'State',
            'state_helper'               => ' ',
            'city'                       => 'City',
            'city_helper'                => ' ',
            'address_1'                  => 'Address 1',
            'address_1_helper'           => ' ',
            'address_2'                  => 'Address 2',
            'address_2_helper'           => ' ',
            'nationality'                => 'Nationality',
            'nationality_helper'         => ' ',
            'country'                    => 'Country',
            'country_helper'             => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'id_type'                    => 'ID Type',
            'id_type_helper'             => ' ',
            'created_by'                 => 'Created By',
            'created_by_helper'          => ' ',
            'mode'                       => 'Payment Options',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Trails',
        'title_singular' => 'Audit Trails',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'order' => [
        'title'          => 'Order Management',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'ref_no'              => 'Reference No',
            'ref_no_helper'       => ' ',
            'amount'              => 'Amount (RM)',
            'amount_helper'       => ' ',
            'order_status'        => 'Order Status',
            'order_status_helper' => ' ',
            'order_date'          => 'Order Date',
            'order_date_helper'   => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'customer'            => 'Customer Name',
            'customer_helper'     => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
            'approved'            => 'Approved',
            'approved_helper'     => ' ',
            'created_by'          => 'Agent Code',
            'created_by_helper'   => ' ',
            'commissions'         => 'Commissions',
            'commissions_helper'  => ' ',
            'orderList'           => 'Order Lists',
            'createOrder'         => 'Create New Order',
        ],
    ],
    'agency' => [
        'title'          => 'Agencies',
        'title_singular' => 'Agency',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Agency Code',
            'name_helper'       => ' ',
            'owner'             => 'User',
            'owner_helper'      => ' ',
        ],
    ],
    'commission' => [
        'title'          => 'Commissions',
        'title_singular' => 'Commission',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'commission'                  => 'Commissions',
            'commission_helper'           => ' ',
            'increased_commission'        => 'Monthly Spin-Off Commission (RM)',
            'increased_commission_helper' => ' ',
            'user'                        => 'Agent Code',
            'user_helper'                 => ' ',
            'order'                       => 'Reference No',
            'order_helper'                => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'team'                        => 'Team',
            'team_helper'                 => ' ',
            'comm_per_order'              => 'Commission Per Order (RM)',
            'comm_monthly'                => 'Total Commissions (Monthly)',
        ],
    ],
    'setting' => [
        'title'           => 'Profile Settings',
        'title_singular'  => 'Profile Setting',
        'profile'         => 'My Profile',
        'change_password' => 'Change Password',
    ],
    'ranking' => [
        'title'           => 'Ranking',
        'title_singular'  => 'Rankings',
        'myRanking'       => 'My Ranking',
        'currentRank'     => 'Current Category',
        'remoteDemote'    => 'Promotion / Demotion',
    ],
    'masterSetting' => [
        'title'     => 'Master Settings',
        'fields'    => [
            'layout'      => 'Layouts',
            'location'    => 'Locations',
            'building'    => 'Building Types',
            'productType' => 'Product Type',
            'levels'      => 'Level',
        ],
    ],
    'location' => [
        'title'          => 'Location',
        'title_singular' => 'Location',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'location_name'        => 'Location Name',
            'location_name_helper' => ' ',
            'state'                => 'State',
            'state_helper'         => ' ',
            'postcode'             => 'Postcode',
            'postcode_helper'      => ' ',
            'city'                 => 'City',
            'city_helper'          => ' ',
            'address_1'            => 'Address 1',
            'address_1_helper'     => ' ',
            'address_2'            => 'Address 2',
            'address_2_helper'     => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'property_name'        => 'Property Name',
            'property_name_helper' => ' ',
        ],
    ],
    'buildingType' => [
        'title'          => 'Building Type',
        'title_singular' => 'Building Type',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'building_name'        => 'Building Name',
            'building_name_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'productType' => [
        'title'          => 'Product Type',
        'title_singular' => 'Product Type',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'property_name'        => 'Product Type Name',
            'property_name_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'building_type'        => 'Building Type',
            'building_type_helper' => ' ',
        ],
    ],
    'level' => [
        'title'          => 'Level',
        'title_singular' => 'Level',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'level_name'           => 'Level Name',
            'level_name_helper'    => ' ',
            'building_type'        => 'Building Type',
            'building_type_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
];
