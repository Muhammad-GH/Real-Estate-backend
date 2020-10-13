import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../../helper/helper";
import { withTranslation } from "react-i18next";

class Decline extends Component {
  state = {
    tb_message: "",
    tb_reason: "",
    tb_feedback: "",
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleCheck = () => {
    this.setState({ agreed: !this.state.agreed });
  };

  handleSubmit = async () => {
    const token = await localStorage.getItem("token");
    const data = new FormData();
    data.set("tb_message", this.state.tb_message);
    data.set("tb_reason", this.state.tb_reason);
    data.set("tb_feedback", this.state.tb_feedback);
    const response = await axios.post(
      `${url}/api/bid/decline/${
        this.props.id
      }/${this.refs.tb_user_id.value.trim()}`,
      data,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    window.location.reload();
    console.log(response);
  };

  render() {
    const { t, i18n } = this.props;

    return (
      <div>
        {/* Modal  */}
        <div
          class="modal fade"
          id="decline"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-11">
                    <input
                      ref="tb_user_id"
                      name="tb_user_id"
                      id="tb_user_id"
                      class="form-control"
                      type="hidden"
                    />
                    <div class="form-group">
                      <label for="reason">{t("modals.decline.reason")}</label>
                      <select
                        name="tb_reason"
                        onChange={this.handleChange}
                        id="reason"
                        class="form-control"
                      >
                        <option>Reason</option>
                        <option>Reason</option>
                        <option>Reason</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="message1">
                        {t("modals.decline.message1")}
                      </label>
                      <textarea
                        name="tb_message"
                        onChange={this.handleChange}
                        id="message1"
                        class="form-control"
                      ></textarea>
                    </div>
                    <div class="form-group">
                      <label for="feedback">
                        {t("modals.decline.feedback")}
                      </label>
                      <input
                        name="tb_feedback"
                        onChange={this.handleChange}
                        id="feedback"
                        class="form-control"
                        type="text"
                      />
                    </div>
                    <button
                      onClick={this.handleSubmit}
                      type="button"
                      class="btn btn-outline-dark mt-3"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      Confirm
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Decline);
