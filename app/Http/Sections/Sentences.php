<?php

namespace App\Http\Sections;

use KodiComponents\Support\Contracts\Initializable;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;

/**
 * Class Sentences
 *
 * @property \App\Model\Sentence $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Sentences extends Section implements Initializable
{
    /**
     * @var \App\Role
     */
    protected $model;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500, function() {
            return \App\Role::count();
        });

        $this->creating(function($config, \Illuminate\Database\Eloquent\Model $model) {
            echo 1;
        });
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-group';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('Предложения');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#'),
                AdminColumn::link('ru', 'Ru'),
                AdminColumn::text('en', 'En')

            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('en', 'English')->required(),
            AdminFormElement::text('ru', 'Russian')->required(),
            AdminFormElement::textarea('description', 'Заметки')
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        // Создание и редактирование записи идентичны, поэтому перенаправляем на метод редактирования
        return $this->onEdit(null);
    }

    /**
     * Переопределение метода содержащего заголовок создания записи
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getCreateTitle()
    {
        return 'Добавить предложение';
    }

    /**
     * Переопределение метода для запрета удаления записи
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function isDeletable(\Illuminate\Database\Eloquent\Model $model)
    {
        return false;
    }

    /**
     * Переопределение метода содержащего ссылку на редактирование записи
     *
     * @param string|int $id
     *
     * @return string
     */
//    public function getEditUrl($id)
//    {
//        return '/admin/sentences/' . $id;
//    }

    /**
     * Переопределение метода содержащего ссылку на удаление записи
     *
     * @param string|int $id
     *
     * @return string
     */
    public function getDeleteUrl($id)
    {
        return 'Ссылка на удаление записи';
    }




}
