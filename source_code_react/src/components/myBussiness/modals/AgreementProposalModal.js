import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

export default class AgreementProposalModal extends Component {
  state = {
    message: "",
    messages: [],
    last_status: 0,
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleSubmit = async () => {
    const token = await localStorage.getItem("token");

    const data = new FormData();
    data.set("message", this.state.message);
    data.set("user_id", this.props.propsObj[0]);
    data.set("propID", this.props.propsObj[1]);
    data.set("client", this.props.propsObj[2]);
    data.set("table_name", this.props.propsObj[3]);
    data.set("notifID", this.props.propsObj[4]);
    data.set("status", this.props.propsObj[6]);

    const response = await axios.post(`${url}/api/revisions/insert`, data, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    window.location.reload();

    // Display the key/value pairs
    // for (var pair of data.entries()) {
    //   console.log(pair[0] + ", " + pair[1]);
    // }
  };

  componentDidUpdate = (prevProps, prevState) => {
    if (prevProps.proposal_id !== this.props.proposal_id) {
      this.loadMessages(this.props.proposal_id, this.props.table);
    }
  };

  loadMessages = async (id, table) => {
    const token = await localStorage.getItem("token");

    const response = await axios.get(
      `${url}/api/revisions/get/${id}/${table}`,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );

    if (response.status === 200) {
      if (response.data.data.length > 0) {
        this.setState({
          messages: response.data.data,
          last_status: response.data.data[response.data.data.length - 1].status,
        });
      }
    }
  };

  render() {
    return (
      <div
        className="modal fade"
        id="agreement-proposal"
        tabIndex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-lg modal-dialog-centered">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="exampleModalLabel">
                View message
              </h5>
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
              <div className="row">
                <div className="col-md-11">
                  <div className="form-group ">
                    {this.state.last_status === 4 ||
                    this.state.last_status === 0 ? (
                      <div>
                        <textarea
                          className="form-control"
                          placeholder="message"
                          name="message"
                          onChange={this.handleChange}
                        ></textarea>
                        <div className="form-group">
                          <button
                            className="btn btn-light"
                            onClick={this.handleSubmit}
                            data-dismiss="modal"
                            aria-label="Close"
                            style={{ background: "#efefef" }}
                          >
                            Send
                          </button>
                        </div>
                      </div>
                    ) : null}

                    <div
                      className="scroller mt-5"
                      style={{ height: 262, margin: 0 }}
                    >
                      <div className="detail-list">
                        {this.state.messages.map(
                          ({ message, created_at, user_name, status }) => (
                            <dl className="d-flex">
                              <dt className="flex-grow-0">{user_name}</dt>
                              <dd>
                                <h5>
                                  {this.props.table === "pro_agreement"
                                    ? "Agreement"
                                    : "Proposal"}{" "}
                                  <b>
                                    {(status === 4 ? "revised" : null) ||
                                      (status === 3 ? "declined" : null) ||
                                      (status === 2 ? "accepted" : null)}
                                  </b>
                                </h5>
                                <p>{message}</p>
                                <span className="date">{created_at}</span>
                              </dd>
                            </dl>
                          )
                        )}
                      </div>
                    </div>
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
