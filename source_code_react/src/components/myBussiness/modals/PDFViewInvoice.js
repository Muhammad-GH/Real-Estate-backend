import React from "react";
import { Helper, url } from "../../../helper/helper";
import { withTranslation } from "react-i18next";

const PDFViewInvoice = ({ businessInfo, userInfo, t }) => {
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
                            <b>{t("proposal_pdf.bill_to")}</b>
                          </p>
                          {userInfo.client_id}
                          <br />
                        </address>
                      </div>
                      <div className="col-md-12 col-lg-4" />
                    </div>
                  </div>
                  <div className="col-md-4">
                    <div className="float-md-right float-sm-none">
                      <h2>{t("proposal_pdf.invoice")}</h2>
                      <address>
                        {t("proposal_pdf.invoice_no")} {userInfo.invoice_number}
                        <br />
                        {t("proposal_pdf.invoice_date")} {userInfo.date}
                        <br />
                        {t("proposal_pdf.reference")} {userInfo.reference}
                        <br />
                        {t("proposal_pdf.account_number")} {userInfo.acc_no}
                        <br />
                        {t("proposal_pdf.payment_duration")} {userInfo.pay_term}
                        <br />
                        {t("proposal_pdf.due_date")} {userInfo.due_date}
                        <br />
                        {t("proposal_pdf.delay_interests")} {userInfo.interest}%
                      </address>
                      <div className="due-amount">
                        <h5>{t("proposal_pdf.amount_due")}</h5>
                        <span className="price">
                          {userInfo.left} {userInfo.totalInput} {userInfo.right}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="pdf-content">
                <div className="table-responsive-md">
                  <table className="table">
                    <thead>
                      <tr>
                        <th>
                          <h3 className="m-0">
                            {t("proposal_pdf.description")}
                          </h3>
                        </th>
                        <th>{t("proposal_pdf.quantity")}</th>
                        <th>{t("proposal_pdf.unit")}</th>
                        <th>{t("proposal_pdf.price")}</th>
                        <th>
                          <h3 className="m-0">{t("proposal_pdf.amount")}</h3>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      {userInfo.itemsInput
                        ? JSON.parse(userInfo.itemsInput).map((item) => (
                            <tr>
                              <td>{item.items}</td>
                              <td>{item.qty}</td>
                              <td>{item.unit}</td>
                              <td>{item.price}</td>
                              <td>
                                {userInfo.left} {item.amount} {userInfo.right}
                              </td>
                            </tr>
                          ))
                        : null}

                      <tr>
                        <td colSpan={6} style={{ padding: "0 !important" }}>
                          <table
                            className="table table-bordered"
                            style={{
                              width: "initial",
                              float: "right",
                              marginTop: 0,
                            }}
                          >
                            <tbody>
                              <tr>
                                <td />
                                <td>{t("proposal_pdf.subtotal")}</td>
                                <td>
                                  {userInfo.left} {userInfo.subInput}{" "}
                                  {userInfo.right}
                                </td>
                              </tr>
                              <tr>
                                <td>{t("proposal_pdf.vat")}</td>
                                <td>{userInfo.taxInput}%</td>
                                <td>{userInfo.taxCalcInput} </td>
                              </tr>
                              <tr>
                                <td />
                                <td>{t("proposal_pdf.total")}</td>
                                <td>
                                  <b>
                                    {userInfo.left} {userInfo.totalInput}{" "}
                                    {userInfo.right}
                                  </b>{" "}
                                         
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <br />
                <br />
                <br />
                <div className="row">
                  <div className="col-md-6">
                    <h4>{t("proposal_pdf.notes")}</h4>
                    <p>{userInfo.note} </p>
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>
                  <div className="col-md-6">
                    <h4>
                      {t("proposal_pdf._terms")} &amp;{" "}
                      {t("proposal_pdf.condition")}{" "}
                    </h4>
                    <p>{userInfo.terms}</p>
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>
                </div>
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

export default withTranslation()(PDFViewInvoice);
