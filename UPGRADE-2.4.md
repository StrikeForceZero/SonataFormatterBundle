UPGRADE FROM 2.3 to 2.4
=======================

Update [IvoryCKEditorBundle](https://github.com/egeloen/IvoryCKEditorBundle) to version 3.x.

The old ```{{ ckeditor_replace() }}``` twig function has been replaced by ```{{ ckeditor_widget() }}```.

[BC] is kept due to a CKEditorExtension who bridge the old tag ```{{ ckeditor_replace() }}``` to the new helper method `renderWidget`.

This introduce new `inline` option.

All relatives changes are available here [IvoryCKEditorUPGRADE](https://github.com/egeloen/IvoryCKEditorBundle/blob/master/UPGRADE.md#25-to-30)
