import React from "react";
import { Helper, url } from "../../../helper/helper";
import { withTranslation } from "react-i18next";

const PDFViewAgreement = ({ businessInfo, userInfo, t }) => {
  return (
    <div
      className="modal fade"
      id="preview-info"
      tabIndex={-1}
      role="dialog"
      aria-labelledby="previewModalLabel"
      aria-hidden="true"
    >
      <div className="modal-dialog modal-xl modal-dialog-centered preview-modal">
        <div className="modal-content">
          <div className="modal-header">
            <button
              type="button"
              className="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div className="modal-body">
            <div className="pdf-section">
              <div className="pdf-header">
                <div className="logo">
                  <img
                    src={
                      url +
                      "/images/marketplace/company_logo/" +
                      businessInfo.company_logo
                    }
                    alt="logo"
                  />
                </div>
                <div className="row">
                  <div className="col-md-8">
                    <div className="row">
                      <div className="col-md-12">
                        <p>
                          <b>{businessInfo.company_id}</b>
                          <br />
                          <b>{`${businessInfo.first_name} ${businessInfo.last_name}`}</b>
                          <br />
                          <b>{businessInfo.email}</b>
                          <br />
                        </p>
                      </div>
                    </div>
                    <div className="row">
                      <div className="col-md-6 col-lg-4">
                        <address>
                          <br />
                          {businessInfo.address}
                          <br />
                          {t("proposal_pdf.phone_no")} {businessInfo.phone}
                          <br />
                          {t("proposal_pdf.business_ID")} {businessInfo.id}
                          <br />
                          {t("proposal_pdf.other_info")}
                        </address>
                      </div>
                      <div className="col-md-6 col-lg-4">
                        <address>
                          <p className="mb-2">
                            {t("proposal_pdf.agreement_to")}
                          </p>
                          <br />
                          {userInfo.client_id}
                          <br />
                        </address>
                      </div>
                      <div className="col-md-12 col-lg-4" />
                    </div>
                  </div>
                  <div className="col-md-4">
                    <div className="float-md-right float-sm-none">
                      <h2>{t("proposal_pdf.agreement")}</h2>
                      <address>
                        {t("proposal_pdf.req")}{" "}
                        {`${businessInfo.user_id}${userInfo.agreement_id}`}
                        <br />
                        {t("proposal_pdf.prop_date")} {userInfo.date}
                        <br />
                        {t("proposal_pdf.due_date")} {userInfo.due_date}
                        <br />
                      </address>
                    </div>
                  </div>
                </div>
              </div>
              <div className="pdf-content">
                <h2>{t("proposal_pdf.project_plan")}</h2>
                <div className="row mb-5">
                  <div className="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5>{t("proposal_pdf.work")}</h5>
                    <table className="table table-striped small">
                      <tbody>
                        {userInfo.work_template !== null ? (
                          JSON.parse(userInfo.work_template.items).map(
                            (item) => (
                              <tr>
                                <td>{item.items}</td>
                              </tr>
                            )
                          )
                        ) : (
                          <tr>
                            <td>None</td>
                          </tr>
                        )}
                      </tbody>
                    </table>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h5>{t("proposal_pdf.material")}</h5>
                    <table className="table table-striped small">
                      <tbody>
                        {userInfo.mat_template !== null ? (
                          JSON.parse(userInfo.mat_template.items).map(
                            (item) => (
                              <tr>
                                <td>{item.items}</td>
                              </tr>
                            )
                          )
                        ) : (
                          <tr>
                            <td>None</td>
                          </tr>
                        )}
                      </tbody>
                    </table>
                  </div>
                  <div className="col-lg-4 col-md-12" />
                </div>
                <h2>{t("proposal_pdf.terms")}</h2>
                <div className="row mb-5">
                  <div className="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <h4>{t("proposal_pdf.total_cost")}</h4>
                    <table className="table table-striped">
                      <tbody>
                        <tr>
                          <td>{t("proposal_pdf.work_cost")}</td>
                          {userInfo.work_template !== null ? (
                            <td className="text-right">
                              {userInfo.left} {userInfo.work_template.total}{" "}
                              {userInfo.right}
                            </td>
                          ) : (
                            <td className="text-right">
                              {userInfo.left} 0 {userInfo.right}
                            </td>
                          )}
                        </tr>
                        <tr>
                          <td>{t("proposal_pdf.material_cost")}</td>
                          {userInfo.mat_template !== null ? (
                            <td className="text-right">
                              {userInfo.left} {userInfo.mat_template.total}{" "}
                              {userInfo.right}
                            </td>
                          ) : (
                            <td className="text-right">
                              {userInfo.left} 0 {userInfo.right}
                            </td>
                          )}
                        </tr>
                        <tr>
                          <td>{t("proposal_pdf.total_cost")}</td>
                          {userInfo.mat_template !== null ? (
                            <td className="text-right">
                              {userInfo.left}{" "}
                              {Number(userInfo.mat_template.total) +
                                Number(userInfo.work_template.total)}{" "}
                              {userInfo.right}
                            </td>
                          ) : (
                            <td className="text-right">
                              {userInfo.left} 0 {userInfo.right}
                            </td>
                          )}
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div className="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h4>{t("proposal_pdf.mat_pay")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>{userInfo.mat_pay}.</p>
                    </div>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h4>{t("proposal_pdf.work_pay")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>
                        {t("proposal_pdf.terms")} : {userInfo.agreement_terms}
                        <br /> {t("proposal_pdf.hourly_price")} :{" "}
                        {userInfo.left} <span id="rate_"></span>{" "}
                        {userInfo.right}
                      </p>
                    </div>
                  </div>
                </div>
                {/*<div class="row mb-5">
                                  <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                                      <h4>Transportation payment terms</h4>
                                      <div class="border p-3 mb-4" style="height: 42px;">
                                          <p>Included</p>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                                      <h4>Panelty Terms</h4>
                                      <div>
                                          <p>Per day delay will cost 0.5% to the contractor.</p>
                                      </div>
                                  </div>
                              </div>*/}
                <div className="row mb-5">
                  <div className="col-lg-8 col-md-12 mb-4 mb-lg-0">
                    <h4>{t("proposal_pdf.terms")}</h4>
                    <table className="table table-striped">
                      <tbody>
                        {userInfo.agreement_milestones.length > 0
                          ? JSON.parse(userInfo.agreement_milestones).map(
                              (milestone, index) => {
                                return (
                                  <tr>
                                    <td class="text-center">{++index}</td>
                                    <td>
                                      {milestone.des}
                                      <br />
                                    </td>
                                    <td>{milestone.due_date}</td>
                                    <td class="text-right">
                                      <b>
                                        {userInfo.left} {milestone.amount}{" "}
                                        {userInfo.right}
                                      </b>
                                    </td>
                                  </tr>
                                );
                              }
                            )
                          : null}
                      </tbody>
                    </table>
                  </div>
                  <div className="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h4>{t("proposal_pdf.trans")}</h4>
                    <div className="border p-3 mb-4" style={{ height: 42 }}>
                      <p>Included</p>
                    </div>
                    <h4>{t("proposal_pdf.panelty_terms")}</h4>
                    <div>
                      <p>{userInfo.agreement_panelty}.</p>
                    </div>
                  </div>
                </div>
                <h2>{t("proposal_pdf.guarantee_insurance")}</h2>
                <div className="row mb-5">
                  <div className="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h4>{t("proposal_pdf.guarantee_work")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>{userInfo.agreement_work_guarantee}</p>
                    </div>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h4>{t("proposal_pdf.guarantee_mat")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>{userInfo.agreement_material_guarantee}</p>
                    </div>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h4>{t("proposal_pdf.agreement_insurance")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>{userInfo.agreement_insurances}</p>
                    </div>
                  </div>
                </div>
                <h2>{t("proposal_pdf.legal")}</h2>
                <div className="row mb-5">
                  <div className="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h4>{t("proposal_pdf.client_res")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>
                        {`${userInfo.agreement_client_res}`} <br />
                        {`custom: ${userInfo.agreement_client_res_other}`}
                      </p>
                    </div>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h4>{t("proposal_pdf.contractor_res")}</h4>
                    <div className="border p-3" style={{ height: 110 }}>
                      <p>
                        {`${userInfo.agreement_contractor_res}`} <br />
                        {`custom: ${userInfo.agreement_contractor_res_other}`}
                      </p>
                    </div>
                  </div>
                  <div className="col-lg-4 col-md-6">
                    <h4>{t("proposal_pdf.legal_terms")}</h4>
                    <div className="form-group">
                      {userInfo.agreement_legal_category
                        ? userInfo.agreement_legal_category
                            .split(",")
                            .map((legal) => (
                              <div className="form-check">
                                <input
                                  type="checkbox"
                                  className="form-check-input"
                                  checked
                                />
                                <label className="form-check-label">
                                  {legal} agreement
                                </label>
                              </div>
                            ))
                        : null}
                    </div>
                  </div>
                </div>
                <br />
                <br />
                <br />
                <br />
                <br />
              </div>
              <div className="pdf-footer">
                <p>{t("proposal_pdf.brand")}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default withTranslation()(PDFViewAgreement);
