import React,  {Component} from 'react'

class Button extends Component {
  render() {
    return (
        <button className="btn btn-dark">{this.props.title}</button>
    )
  }
}

// console.log(props)
export default Button
