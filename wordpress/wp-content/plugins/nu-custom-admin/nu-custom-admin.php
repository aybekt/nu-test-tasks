<?php
/**
 * Plugin Name: NU Custom Admin
 * Название плагина: NU Custom Admin
 * Description: Скрывает типы записей «Записи» и «Страницы», добавляет кастомную страницу в админке.
 * Описание: Скрывает типы записей «Записи» и «Страницы», добавляет кастомную страницу в админке.
 * Version: 1.0.0
 * Версия: 1.0.0
 */

/**
 * Этот плагин нужен для тестового задания:
 * 1) скрывает пункты «Записи» и «Страницы» из меню админки;
 * 2) добавляет страницу в меню администратора с произвольным контентом.
 */

if (!defined('ABSPATH')) {
    exit;
}

final class NuCustomAdminPlugin
{
    private const PAGE_SLUG = 'nu-custom-content';
    private const TEXT_DOMAIN = 'nu-custom-admin';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'hideDefaultPostTypes'], 999);
        add_action('admin_bar_menu', [$this, 'hideAdminBarNewLinks'], 999);
        add_action('admin_menu', [$this, 'registerCustomPage']);
        add_action('admin_init', [$this, 'redirectHiddenListScreens']);
    }

    public function hideDefaultPostTypes(): void
    {
        remove_menu_page('edit.php');
        remove_menu_page('edit.php?post_type=page');
    }

    public function hideAdminBarNewLinks(\WP_Admin_Bar $bar): void
    {
        $bar->remove_node('new-post');
        $bar->remove_node('new-page');
    }

    public function registerCustomPage(): void
    {
        add_menu_page(
            __('Кастомный раздел NU', self::TEXT_DOMAIN),
            __('Кастомный раздел NU', self::TEXT_DOMAIN),
            'manage_options',
            self::PAGE_SLUG,
            [$this, 'renderCustomPage'],
            'dashicons-layout',
            3
        );
    }

    public function renderCustomPage(): void
    {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Страница кастомного плагина', self::TEXT_DOMAIN); ?></h1>
            <p><?php echo esc_html__('Произвольный контент для демонстрации тестового задания.', self::TEXT_DOMAIN); ?></p>
            <div class="card" style="max-width: 720px; padding: 16px;">
                <h2><?php echo esc_html__('Что делает плагин', self::TEXT_DOMAIN); ?></h2>
                <ul style="list-style: disc; margin-left: 1.25em;">
                    <li><?php echo esc_html__('Скрывает меню «Записи» и «Страницы».', self::TEXT_DOMAIN); ?></li>
                    <li><?php echo esc_html__('Убирает быстрые ссылки «Новая запись» / «Новая страница» из верхней панели.', self::TEXT_DOMAIN); ?></li>
                    <li><?php echo esc_html__('Перенаправляет прямой заход в списки скрытых типов на эту страницу.', self::TEXT_DOMAIN); ?></li>
                </ul>
            </div>
        </div>
        <?php
    }

    public function redirectHiddenListScreens(): void
    {
        if (!is_admin()) {
            return;
        }

        global $pagenow;

        if ($pagenow !== 'edit.php') {
            return;
        }

        $post_type = isset($_GET['post_type']) ? sanitize_key((string) $_GET['post_type']) : 'post';

        if (!in_array($post_type, ['post', 'page'], true)) {
            return;
        }

        wp_safe_redirect(admin_url('admin.php?page=' . self::PAGE_SLUG));
        exit;
    }
}

new NuCustomAdminPlugin();
