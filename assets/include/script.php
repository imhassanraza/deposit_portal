

<!-- <footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<span class="txt-color-white">CoreYatırım © 2019</span>
			</div>
		</div>
	</div>
</footer>
 -->

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

  <script type="text/javascript">

    $(function() {
      var tab = $('.tabs h3 a');
      tab.on('click', function(event) {
        event.preventDefault();
        tab.removeClass('active');
        $(this).addClass('active');
        tab_content = $(this).attr('href');
        $('div[id$="tab-content"]').removeClass('active');
        $(tab_content).addClass('active');
      });
    });


// CUSTOM JQUERY FUNCTION FOR SWAPPING CLASSES
(function($) {
	'use strict';
	$.fn.swapClass = function(remove, add) {
		this.removeClass(remove).addClass(add);
		return this;
	};
}(jQuery));

// SHOW/HIDE PANEL ROUTINE (needs better methods)
// I'll optimize when time permits.
$(function() {
	$('.agree,.forgot, #toggle-terms, .log-in, .sign-up').on('click', function(event) {
		event.preventDefault();
		var terms = $('.terms'),
    recovery = $('.recovery'),
    close = $('#toggle-terms'),
    arrow = $('.tabs-content .fa');
    if ($(this).hasClass('agree') || $(this).hasClass('log-in') || ($(this).is('#toggle-terms')) && terms.hasClass('open')) {
      if (terms.hasClass('open')) {
        terms.swapClass('open', 'closed');
        close.swapClass('open', 'closed');
        arrow.swapClass('active', 'inactive');
      } else {
        if ($(this).hasClass('log-in')) {
          return;
        }
        terms.swapClass('closed', 'open').scrollTop(0);
        close.swapClass('closed', 'open');
        arrow.swapClass('inactive', 'active');
      }
    }
    else if ($(this).hasClass('forgot') || $(this).hasClass('sign-up') || $(this).is('#toggle-terms')) {
      if (recovery.hasClass('open')) {
        recovery.swapClass('open', 'closed');
        close.swapClass('open', 'closed');
        arrow.swapClass('active', 'inactive');
      } else {
        if ($(this).hasClass('sign-up')) {
          return;
        }
        recovery.swapClass('closed', 'open');
        close.swapClass('closed', 'open');
        arrow.swapClass('inactive', 'active');
      }
    }
  });
});

</script>

<script type="text/javascript">
  $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
      $item = $(this);

      if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-primary').addClass('btn-default');
        $item.addClass('btn-primary');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
      }
    });

    allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
      curInputs = curStep.find("input[type='text'],input[type='url']"),
      isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
        if (!curInputs[i].validity.valid){
          isValid = false;
          $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
      }

      if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
  });
</script>
