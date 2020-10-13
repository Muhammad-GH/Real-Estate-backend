import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

class RatingModal extends Component {
  state = {
    reason: "",
    rating: null,
    message: "",
    feedback: "",
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleSubmit = async (event) => {
    event.preventDefault();
    const token = await localStorage.getItem("token");

    const data = new FormData();
    data.set("reason", this.state.reason);
    data.set("message", this.state.message);
    data.set("feedback", this.state.feedback);
    data.set("rating", this._rating.value);

    axios
      .post(`${url}/api/rating/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        alert("Saved!");
      })
      .catch((err) => {
        alert("Some error occured , try again");
      });
  };

  render() {
    return (
      <div
        className="modal fade"
        id="closeagreement"
        tabIndex={-1}
        role="dialog"
        aria-labelledby="closeAgreementModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-md modal-dialog-centered">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="closeAgreementModalLabel">
                Edit Business Information
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
              <form>
                <div className="form-group">
                  <label htmlFor="reason">Reason for closing project</label>
                  <input
                    id="reason"
                    className="form-control"
                    type="text"
                    name="reason"
                    placeholder
                    onChange={this.handleChange}
                  />
                  {/*<small class="form-text text-muted">
                                        eg sub contractors, material supplier, team etc
                                    </small>*/}
                </div>
                <div className="form-group">
                  <label>Rate the contractor</label>
                  <div className="rating-stars">
                    <ul id="stars">
                      <li className="star" title="Poor" data-value={1}>
                        <i className="icon-star-full" />
                      </li>
                      <li className="star" title="Fair" data-value={2}>
                        <i className="icon-star-full" />
                      </li>
                      <li className="star" title="Good" data-value={3}>
                        <i className="icon-star-full" />
                      </li>
                      <li className="star" title="Excellent" data-value={4}>
                        <i className="icon-star-full" />
                      </li>
                      <li className="star" title="WOW!!!" data-value={5}>
                        <i className="icon-star-full" />
                      </li>
                    </ul>
                    <span className="count">
                      <span>0</span>/5
                      <input
                        type="hidden"
                        ref={(input) => {
                          this._rating = input;
                        }}
                        class="_rating"
                      />
                    </span>
                  </div>
                </div>
                <div className="form-group">
                  <label htmlFor="message">Message for contractor</label>
                  <input
                    id="message"
                    className="form-control"
                    type="text"
                    name="message"
                    placeholder
                    onChange={this.handleChange}
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="feedback">Flipkoti experience feedback</label>
                  <input
                    id="feedback"
                    className="form-control"
                    type="text"
                    name="feedback"
                    placeholder
                    onChange={this.handleChange}
                  />
                </div>
                <button
                  type="submit"
                  onClick={this.handleSubmit}
                  className="btn btn-outline-secondary mt-3"
                >
                  Confirm
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default RatingModal;
