<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 7.4.0
 */

defined( 'ABSPATH' ) || exit;
?>
																		</div>
																	</td>
																</tr>
															</table>
															<!-- End Content -->
														</td>
													</tr>
												</table>
												<!-- End Body -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Footer -->
                                    <table id="footer" width="100%" height="auto" border="0" cellpadding="0" cellspacing="0">
                                        <tr bgcolor="#2E4259" height="80">
                                            <td rowspan="2" width="33%" style="padding-left: 30px;">
                                                <img src="<?php echo get_bloginfo("url");?>/wp-content/uploads/2023/09/logo_email.png" width="163" height="41" alt="ISIL_GO" align="top" border="0"></td>
                                            <td width="67%" style="text-align: right; vertical-align: bottom; padding: 0px 30px 5px 0px;">
                                                <p style="color: #fff; font-weight: 800; line-height: 30px; margin:0px; font-size:16px; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;">
                                                    Síguenos en
                                                    <a href="https://www.facebook.com/PotenciaTuTalento/" target="_blank" style="color: #2E4259;">
                                                        <img src="<?php echo get_bloginfo("url");?>/wp-content/uploads/2023/09/facebook_email.png" width="30" height="31" alt="Facebook" align="top" border="0" style="padding: 0px 2px 0px 6px; margin: 0px;">
                                                    </a>
                                                    <a href="https://www.instagram.com/isil_go/" target="_blank" style="color: #2E4259;">
                                                        <img src="<?php echo get_bloginfo("url");?>/wp-content/uploads/2023/09/instagram_email.png" width="30" height="31" alt="Instagram" align="top" border="0" style="padding: 0px 2px; margin: 0px;">
                                                    </a>
                                                    <a href="https://twitter.com/i/flow/login?redirect_after_login=%2Fisil_pe" target="_blank" style="color: #2E4259;">
                                                        <img src="<?php echo get_bloginfo("url");?>/wp-content/uploads/2023/09/twitter_email.png" width="30" height="31" alt="Twitter" align="top" border="0" style="padding: 0px 2px; margin: 0px;">
                                                    </a>
                                                    <a href="https://www.youtube.com/channel/UC2-vhK7k9G14m8b5Htn0Sbw" target="_blank" style="color: #2E4259;">
                                                        <img src="<?php echo get_bloginfo("url");?>/wp-content/uploads/2023/09/youtube_email.png" width="30" height="31" alt=Youtube"" align="top" border="0" style="padding: 0px 2px; margin: 0px;">
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr bgcolor="#2E4259" height="60">
                                            <td width="67%" style="text-align: right; vertical-align: top; padding: 5px 30px 0px 0px;">
                                                <p style="color: #fff; font-weight: 700; font-size: 12px; margin:0px; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;">
                                                    <a href="https://isilgo.com/" target="_blank" style="text-decoration: none; color: #fff; padding: 0px 5px;">
                                                        www.isilgo.com
                                                    </a>
                                                    <a href="mailto:comunidad@isilgo.pe" target="_blank" style="text-decoration: none; color: #fff; border-left: solid 1px #fff; border-right: solid 1px #fff; padding: 0px 5px;">
                                                        comunidad@isilgo.pe
                                                    </a>
                                                    <a href="tel:51946514592" target="_blank" style="text-decoration: none; color: #fff; padding: 0px 5px;">
														+51946514592
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
									<!-- <table border="0" cellpadding="10" cellspacing="0" width="100%" id="template_footer">
										<tr>
											<td valign="top">
												<table border="0" cellpadding="10" cellspacing="0" width="100%">
													<tr>
														<td colspan="2" valign="middle" id="credit">
															<?php
															echo wp_kses_post(
																wpautop(
																	wptexturize(
																		/**
																		 * Provides control over the email footer text used for most order emails.
																		 *
																		 * @since 4.0.0
																		 *
																		 * @param string $email_footer_text
																		 */
																		apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) )
																	)
																)
															);
															?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table> -->
                                    
									<!-- End Footer -->
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td><!-- Deliberately empty to support consistent sizing and layout across multiple email clients. --></td>
			</tr>
		</table>
	</body>
</html>
<php
global $order;
var_dump($order);
?>