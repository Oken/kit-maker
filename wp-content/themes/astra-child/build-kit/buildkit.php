<div id="wrapper">
    <div class="wrapper">
        <!-- The loading element overlays all else until the model is loaded, at which point we remove this element from the DOM -->
        <!--<div class="loading" id="js-loader">
            <div class="loader">-->
        <!-- Just a quick notice to the user that it can be interacted with -->
        <span class="drag-notice" id="js-drag-notice">Drag to rotate 360&#176;</span>
        <!-- These toggle the the different parts of the chair that can be edited, note data-option is the key that links to the name of the part in the 3D file -->
        <div class="options">
            <div class="option --is-active" data-option="shirt">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/build-kit/svg/shirt.svg" alt="shirt" />
            </div>
            <div class="option" data-option="short">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/build-kit/svg/short.svg" alt="short" />
            </div>
            <div class="option" data-option="socks">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/build-kit/svg/socks.svg" alt="socks" />
            </div>
        </div>
        <!-- The canvas element is used to draw the 3D scene -->
        <div id="canvas-wrapper">
            <canvas id="c"></canvas>
        </div>

        <div class="controls">
            <div class="info">
                <div id="info__message">
                    <p><strong>&nbsp;Grab&nbsp;</strong> to rotate model. <strong>&nbsp;Scroll&nbsp;</strong> to zoom.
                        <strong>&nbsp;Drag&nbsp;</strong> swatches left & right to view more.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div id="change">
        <h3 id="change-title">Choose what to customize</h3>
        <div id=" textures">
            <h5>Texture</h5>
            <div class="tray1">
                <div id="texture" class="tray_texture_slide"></div>
            </div>
        </div>
        <div>
            <h5 class="coloring">Primary Color</h5>
            <!-- This tray will be filled with colors via JS, and the ability to slide this panel will be added in with a lightweight slider script (no dependency used for this) -->
            <div id="primary_" class="tray">
                <div id="0" class="js-tray-slide tray_color_slide"></div>
            </div>
        </div>
        <div id="secondary_">
            <h5 class="coloring">Secondary Color</h5>
            <div class="tray">
                <div id="1" class="js-tray-slide"><button>Click to see color swatches</button></div>
            </div>
        </div>
        <div id="accent1">
            <h5 class="coloring">Accent1 Color</h5>
            <div class="tray">
                <div id="2" class="js-tray-slide"><button>Click to see color swatches</button></div>
            </div>
        </div>
        <div id=" accent2">
            <h5 class="coloring">Accent2 Color<h5>
            <div class="tray">
                <div id="3" class="js-tray-slide"><button>Click to see color swatches</button></div>
            </div>
        </div>

    </div>

    <div id="call-to-actions">
        <h3>There you are!</h3>
        <div id="actions">
            <button id="view-image" class="action">View Your Product</button>
            <button id="download-image" class="action">Download a Copy</button>
            <button id="add-to-cart" class="action">Add to Cart</button>
        </div>
    </div>
</div>