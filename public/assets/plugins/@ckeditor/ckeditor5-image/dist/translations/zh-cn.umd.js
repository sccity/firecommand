/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( e => {
const { [ 'zh-cn' ]: { dictionary, getPluralForm } } = {"zh-cn":{"dictionary":{"image widget":"图片组件","Wrap text":"文字环绕","Break text":"文字断行","In line":"行内","Side image":"图片侧边显示","Full size image":"全尺寸图片","Left aligned image":"图片左侧对齐","Centered image":"图片居中","Right aligned image":"图片右侧对齐","Change image text alternative":"更改图片替换文本","Text alternative":"替换文本","Enter image caption":"输入图片标题","Insert image":"插入图像","Replace image":"替换图片","Upload from computer":"从电脑上传","Replace from computer":"从电脑替换","Upload image from computer":"从电脑上传图片","Image from computer":"从计算机中选择图片","From computer":"从电脑","Replace image from computer":"从电脑替换图片","Upload failed":"上传失败","Image toolbar":"图片工具栏","Resize image":"调整图像大小","Resize image to %0":"调整图像大小为%0","Resize image to the original size":"调整图像大小为原始大小","Resize image (in %0)":"调整图片大小（单位为 %0）","Original":"原始大小","Custom image size":"自定义图片大小","Custom":"自定义","Image resize list":"图片大小列表","Insert image via URL":"通过URL地址插入图片","Insert via URL":"通过 URL 插入","Image via URL":"来自 URL 的图像","Via URL":"通过 URL","Update image URL":"更新图片URL地址","Caption for the image":"图片说明：","Caption for image: %0":"图片说明：%0","The value must not be empty.":"该值不能为空。","The value should be a plain number.":"该值应当为纯数字。","Uploading image":"正在上传图片","Image upload complete":"图片上传完成","Error during image upload":"图片上传时出错","Image":"图像"},getPluralForm(n){return 0;}}};
e[ 'zh-cn' ] ||= { dictionary: {}, getPluralForm: null };
e[ 'zh-cn' ].dictionary = Object.assign( e[ 'zh-cn' ].dictionary, dictionary );
e[ 'zh-cn' ].getPluralForm = getPluralForm;
} )( window.CKEDITOR_TRANSLATIONS ||= {} );
