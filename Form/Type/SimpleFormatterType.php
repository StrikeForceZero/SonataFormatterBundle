<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\FormatterBundle\Form\Type;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SimpleFormatterType extends AbstractType
{
    /**
     * @var CKEditorType
     */
    protected $CKEditorType;

    /**
     * Constructor.
     *
     * @param CKEditorType $CKEditorType
     * @internal param ConfigManagerInterface $configManager An Ivory CKEditor bundle configuration manager
     */
    public function __construct(CKEditorType $CKEditorType)
    {
        $this->CKEditorType = $CKEditorType;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $ckeditorConfiguration = array(
            'toolbar' => array_values($options['ckeditor_toolbar_icons']),
        );

        if ($options['ckeditor_context']) {
            $contextConfig = $this->CKEditorType->getConfigManager()->getConfig($options['ckeditor_context']);
            $ckeditorConfiguration = array_merge($ckeditorConfiguration, $contextConfig);
        }

        $view->vars['ckeditor_configuration'] = $ckeditorConfiguration;
        $view->vars['ckeditor_plugins'] = $options['ckeditor_plugins'];
        $view->vars['ckeditor_styles'] = $options['ckeditor_styles'];
        $view->vars['ckeditor_templates'] = $options['ckeditor_templates'];
        $view->vars['ckeditor_auto_inline'] = $options['ckeditor_auto_inline'];
        $view->vars['ckeditor_inline'] = $options['ckeditor_inline'];
        $view->vars['ckeditor_input_sync'] = $options['ckeditor_input_sync'];

        $view->vars['format'] = $options['format'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'ckeditor_toolbar_icons'    => array(array(
                 'Bold', 'Italic', 'Underline',
                 '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                 '-', 'Undo', 'Redo',
                 '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                 '-', 'Blockquote',
                 '-', 'Image', 'Link', 'Unlink', 'Table', ),
                 array('Maximize', 'Source'),
            ),
            'ckeditor_basepath'         => $this->CKEditorType->getBasePath(),
            'ckeditor_context'          => null,
            'ckeditor_plugins'          => $this->CKEditorType->getPluginManager()->getPlugins(),
            'ckeditor_styles'           => $this->CKEditorType->getStylesSetManager()->getStylesSets(),
            'ckeditor_templates'        => $this->CKEditorType->getTemplateManager()->getTemplates(),
            'ckeditor_auto_inline'      => $this->CKEditorType->isAutoInline(),
            'ckeditor_inline'           => $this->CKEditorType->isInline(),
            'ckeditor_input_sync'       => $this->CKEditorType->isInputSync(),
            'format_options'      => array(
                'attr' => array(
                    'class' => 'span10 col-sm-10 col-md-10',
                    'rows'  => 20,
                ),
            ),
        ));

        $resolver->setRequired(array(
            'format',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sonata_simple_formatter_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
