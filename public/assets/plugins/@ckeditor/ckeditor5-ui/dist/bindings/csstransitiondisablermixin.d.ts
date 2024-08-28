/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
/**
 * @module ui/bindings/csstransitiondisablermixin
 */
import type { Constructor, Mixed } from '@ckeditor/ckeditor5-utils';
import type View from '../view.js';
/**
 * A mixin that brings the possibility to temporarily disable CSS transitions using
 * {@link module:ui/view~View} methods. It is helpful when, for instance, the transitions should not happen
 * when the view is first displayed but they should work normal in other cases.
 *
 * The methods to control the CSS transitions are:
 * * `disableCssTransitions()` – Adds the `.ck-transitions-disabled` class to the
 * {@link module:ui/view~View#element view element}.
 * * `enableCssTransitions()` – Removes the `.ck-transitions-disabled` class from the
 * {@link module:ui/view~View#element view element}.
 *
 * The usage comes down to:
 *
 * ```ts
 * const MyViewWithCssTransitionDisabler = CssTransitionDisablerMixin( MyView );
 * const view = new MyViewWithCssTransitionDisabler();
 *
 * // ...
 *
 * view.disableCssTransitions();
 * view.show();
 * view.enableCssTransitions();
 * ```
 *
 * @param view View instance that should get this functionality.
 */
export default function CssTransitionDisablerMixin<Base extends Constructor<View>>(view: Base): Mixed<Base, ViewWithCssTransitionDisabler>;
export type ViewWithCssTransitionDisabler = View & {
    disableCssTransitions(): void;
    enableCssTransitions(): void;
};
