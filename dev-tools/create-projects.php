<?php
/**
 * Temporary script to create sample projects
 * 
 * This file can be accessed via browser to create sample projects
 * URL: http://localhost/wp-content/themes/atlas-theme/create-projects.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to access this page.');
}

// Include the sample project data
require_once(__DIR__ . '/sample-project-data.php');

echo '<h1>Creating Sample Projects...</h1>';

// Create the projects
atlas_theme_create_sample_projects();

echo '<h2>✅ Sample projects created successfully!</h2>';
echo '<p><a href="' . admin_url('edit.php?post_type=atlas_project') . '">View Projects</a></p>';
echo '<p><a href="' . home_url() . '">View Homepage</a></p>';
?>
