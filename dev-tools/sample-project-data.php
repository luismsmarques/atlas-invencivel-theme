<?php
/**
 * Sample Project Data for Case Study Demo
 * 
 * This file contains sample data that can be used to create example projects
 * for demonstrating the case study functionality.
 * 
 * @package AtlasTheme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sample Projects Data
 * 
 * Use this data to create example projects in WordPress admin
 */
$sample_projects = array(
    array(
        'title' => 'Musical Covers Platform',
        'content' => 'A revolutionary web platform that connects music artists with cover song opportunities. The platform features advanced search algorithms, real-time collaboration tools, and integrated payment systems.',
        'excerpt' => 'A comprehensive web platform revolutionizing how artists discover and collaborate on cover songs.',
        'category' => 'Web Platform | Music Industry',
        'client' => 'MusicTech Solutions',
        'date' => 'Q2 2023',
        'url' => 'https://musicalcovers.com',
        'technologies' => 'WordPress, PHP, JavaScript, React, MySQL, AWS',
        'challenges' => 'The main challenges included creating a scalable architecture to handle thousands of concurrent users, implementing real-time collaboration features, and developing an intuitive user interface that appeals to both technical and non-technical users. We also needed to integrate complex licensing systems for cover songs and ensure secure payment processing.',
        'solutions' => 'We developed a microservices architecture using WordPress as the CMS backend and React for the frontend. Implemented WebSocket connections for real-time collaboration, created a custom search engine with Elasticsearch, and integrated Stripe for secure payments. The UI was designed with a mobile-first approach and extensive user testing.',
        'results' => 'The platform launched successfully with 10,000+ registered users in the first month. User engagement increased by 300% compared to the previous system. The platform now processes over $50,000 in transactions monthly and has facilitated over 1,000 successful cover song collaborations. Client satisfaction scores are consistently above 4.8/5.',
        'featured_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=600&fit=crop'
    ),
    array(
        'title' => 'MADS Network Digital Transformation',
        'content' => 'Led the complete digital transformation of MADS Network, implementing modern web technologies, automated marketing systems, and data-driven decision making processes. The project involved restructuring the entire digital infrastructure and training the team on new technologies.',
        'excerpt' => 'Complete digital transformation and modernization of marketing operations and web infrastructure.',
        'category' => 'CTO & Digital Marketing',
        'client' => 'MADS Network',
        'date' => '2022-2023',
        'url' => 'https://madsnetwork.com',
        'technologies' => 'WordPress, HubSpot, Google Analytics, Salesforce, Python, Docker',
        'challenges' => 'The company was using outdated systems that couldn\'t scale with their growing business. Manual processes were consuming too much time, and there was no unified view of customer data. The team lacked technical expertise to implement modern solutions.',
        'solutions' => 'Implemented a comprehensive digital transformation strategy including modern CRM integration, automated marketing workflows, custom analytics dashboards, and cloud infrastructure. Provided extensive training and documentation to ensure team adoption. Created custom APIs to connect disparate systems.',
        'results' => 'Reduced manual work by 70% through automation. Improved lead conversion rates by 150%. Decreased system response times by 80%. The company now has real-time visibility into all marketing metrics and customer interactions. Team productivity increased significantly with the new streamlined processes.',
        'featured_image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=600&fit=crop'
    ),
    array(
        'title' => 'AngelsWay Investment Platform',
        'content' => 'Developed a comprehensive investment platform for AngelsWay, enabling angel investors to discover, evaluate, and invest in promising startups. The platform includes advanced analytics, due diligence tools, and portfolio management features.',
        'excerpt' => 'A sophisticated investment platform connecting angel investors with high-potential startups.',
        'category' => 'Angel Investor | Startups',
        'client' => 'AngelsWay Investment Group',
        'date' => '2023',
        'url' => 'https://angelsway.com',
        'technologies' => 'Laravel, Vue.js, PostgreSQL, Redis, Stripe, AWS',
        'challenges' => 'Creating a secure platform for handling sensitive financial data and investor information. Implementing complex algorithms for startup evaluation and risk assessment. Ensuring compliance with financial regulations and maintaining investor privacy.',
        'solutions' => 'Built a secure, scalable platform with end-to-end encryption, multi-factor authentication, and comprehensive audit trails. Developed custom algorithms for startup scoring and risk assessment. Implemented robust compliance features and created detailed investor dashboards with real-time portfolio analytics.',
        'results' => 'Successfully facilitated over $5M in investments within the first 6 months. Platform now hosts 500+ active investors and 1,200+ startup profiles. Average deal closure time reduced by 60%. Investor satisfaction scores of 4.9/5. The platform has become a leading destination for angel investing in the region.',
        'featured_image' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=800&h=600&fit=crop'
    ),
    array(
        'title' => 'Atlas Invencível Leadership Platform',
        'content' => 'As CEO of Atlas Invencível, I led the development of a comprehensive leadership and business development platform. The project involved creating educational content, implementing mentorship programs, and building a community of entrepreneurs and business leaders.',
        'excerpt' => 'A comprehensive leadership development platform fostering entrepreneurship and business growth.',
        'category' => 'CEO | Company Leadership',
        'client' => 'Atlas Invencível',
        'date' => '2021-Present',
        'url' => 'https://atlasinvencivel.com',
        'technologies' => 'WordPress, LearnDash, BuddyPress, WooCommerce, Mailchimp, Zoom API',
        'challenges' => 'Creating a scalable platform that could serve thousands of users while maintaining high-quality educational content. Building a strong community and ensuring engagement. Developing effective mentorship matching algorithms and managing diverse learning paths.',
        'solutions' => 'Developed a comprehensive learning management system with personalized learning paths, interactive content, and community features. Implemented advanced user analytics to track progress and engagement. Created automated mentorship matching based on skills, goals, and availability. Built robust community features with forums, events, and networking opportunities.',
        'results' => 'Platform now serves over 5,000 active users with 95% completion rates for core programs. Community engagement has grown by 400% with active discussions and networking events. Successfully matched 800+ mentorship relationships. Generated $2M+ in revenue through premium memberships and courses. The platform has become a leading resource for entrepreneurship education in the region.',
        'featured_image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop'
    )
);

/**
 * Function to create sample projects
 * 
 * Call this function to create the sample projects in WordPress
 */
function atlas_theme_create_sample_projects() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    global $sample_projects;
    
    foreach ( $sample_projects as $project_data ) {
        // Check if project already exists
        $existing_post = get_page_by_title( $project_data['title'], OBJECT, 'atlas_project' );
        
        if ( $existing_post ) {
            continue; // Skip if project already exists
        }
        
        // Create the project post
        $post_id = wp_insert_post( array(
            'post_title'    => $project_data['title'],
            'post_content'  => $project_data['content'],
            'post_excerpt'  => $project_data['excerpt'],
            'post_status'   => 'publish',
            'post_type'     => 'atlas_project',
            'post_author'   => get_current_user_id(),
        ) );
        
        if ( $post_id ) {
            // Add meta fields
            update_post_meta( $post_id, '_atlas_project_category', $project_data['category'] );
            update_post_meta( $post_id, '_atlas_project_client', $project_data['client'] );
            update_post_meta( $post_id, '_atlas_project_date', $project_data['date'] );
            update_post_meta( $post_id, '_atlas_project_url', $project_data['url'] );
            update_post_meta( $post_id, '_atlas_project_technologies', $project_data['technologies'] );
            update_post_meta( $post_id, '_atlas_project_challenges', $project_data['challenges'] );
            update_post_meta( $post_id, '_atlas_project_solutions', $project_data['solutions'] );
            update_post_meta( $post_id, '_atlas_project_results', $project_data['results'] );
            
            // Set featured image (if URL is provided)
            if ( ! empty( $project_data['featured_image'] ) ) {
                $image_id = atlas_theme_upload_image_from_url( $project_data['featured_image'], $project_data['title'] );
                if ( $image_id ) {
                    set_post_thumbnail( $post_id, $image_id );
                }
            }
        }
    }
}

/**
 * Helper function to upload image from URL
 */
function atlas_theme_upload_image_from_url( $image_url, $title ) {
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    
    $tmp = download_url( $image_url );
    
    if ( is_wp_error( $tmp ) ) {
        return false;
    }
    
    $file_array = array(
        'name'     => sanitize_file_name( $title . '.jpg' ),
        'tmp_name' => $tmp
    );
    
    $id = media_handle_sideload( $file_array, 0 );
    
    if ( is_wp_error( $id ) ) {
        @unlink( $file_array['tmp_name'] );
        return false;
    }
    
    return $id;
}

// Uncomment the line below to create sample projects
add_action( 'init', 'atlas_theme_create_sample_projects' );
